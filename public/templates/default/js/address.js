$(function() {
	$('#addressModal').on('hidden.bs.modal', function(e) {
		// Force refresh modal content
		$(e.target).removeData('bs.modal')
			.empty();
	});
});

function submitAddress(form) {
	var data = $(form).serialize();
	$.post(form.action, data, addressResponse);
}

function addressResponse(res) {
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
