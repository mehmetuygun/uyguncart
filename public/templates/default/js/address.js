$(function() {
	$('#addressModal').on('hidden.bs.modal', function(e) {
		// Force refresh modal content
		$(e.target).removeData('bs.modal');
	});
});
