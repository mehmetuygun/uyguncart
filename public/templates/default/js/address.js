$(function() {
	$('#addressModal').on('hidden.bs.modal', function(e) {
		// Force refresh modal content
		$(e.target).removeData('bs.modal')
			.empty();
	});
});

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

function addressSaveResponse(res) {
	var addressModal = $('#addressModal');

	// Cleanup the errors
	addressModal.find('.form-group').removeClass('has-error');
	addressModal.find('.help-block').empty();

	if (res.success) {
		addressModal.modal('hide');
		alert('Changes were saved successfully.');
		return;
	}

	if (!res.errors) {
		alert('An error occured.');
		return;
	}

	// Show the errors
	for (var i in res.errors) {
		var cur = res.errors[i];
		var f_elem = addressModal.find('[name=' + cur.field + ']');
		f_elem.closest('.form-group').addClass('has-error');
		f_elem.siblings('.help-block').html(cur.error);
	}
}

function addressDeleteResponse(res) {
	alert(JSON.stringify(res));
}
