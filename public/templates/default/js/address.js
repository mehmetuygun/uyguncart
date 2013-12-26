$(function() {
	$('#addressModal').on('hidden.bs.modal', function(e) {
		// Force refresh modal content
		$(e.target).removeData('bs.modal')
			.empty();
	});

	getAddressList();
});

function getAddressList() {
	$.get(base_url + 'address/get_list', loadAddressList);
}

function saveAddress(form) {
	var data = $(form).serialize();
	$.post(form.action, data, addressSaveResponse);
}

function deleteAddress(anchor) {
	if (!confirm('Are you sure you want to delete the address?')) {
		return;
	}

	var url = anchor.href;
	$.get(anchor.href, addressDeleteResponse);
}

function loadAddressList(res) {
	var cur,
		details,
		actions,
		html = '',
		edit_url = base_url + 'address/edit/',
		delete_url = base_url + 'address/delete/',
		addr_table = $('#address_table tbody');

	for (var i=0; i < res.length; i++) {
		cur = res[i];

		details = [
			cur['full_name'],
			cur['address1'],
			cur['address2'],
			cur['city'],
			cur['postcode'],
			cur['country_name']
		];
		actions = [
			'<a href="' + edit_url + cur['address_id'] + '" data-target="#addressModal" data-toggle="modal">Edit</a>',
			'<a href="' + delete_url + cur['address_id'] + '" onclick="deleteAddress(this); return false">Delete</a>'
		];

		html += '<tr>';
		html += '<td>' + (i+1) + '</td>';
		html += '<td>' + details.join(' ')  + '</td>';
		html += '<td>' + actions.join(' ')  + '</td>';
		html += '</tr>';
	}

	addr_table.html(html);
}

function addressSaveResponse(res) {
	var addressModal = $('#addressModal');

	// Cleanup the errors
	addressModal.find('.form-group').removeClass('has-error');
	addressModal.find('.help-block').empty();

	if (res.success) {
		addressModal.modal('hide');
		alert('Changes were saved successfully.');
		getAddressList();
		return;
	}

	if (!res.errors) {
		alert('An error occured while saving changes.');
		return;
	}

	// Show the errors
	for (var i in res.errors) {
		var cur = res.errors[i],
			f_elem = addressModal.find('[name=' + cur.field + ']');
		f_elem.closest('.form-group').addClass('has-error');
		f_elem.siblings('.help-block').html(cur.error);
	}
}

function addressDeleteResponse(res) {
	if (res.success) {
		alert('Address was deleted successfully.');
		getAddressList();
		return;
	}

	alert('An error occured while deleting address.');
}
