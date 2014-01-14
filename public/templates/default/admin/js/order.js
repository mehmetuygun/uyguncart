$(function() {
	$('#OrderDetail').on('hidden', function() {
		$(this).removeData('modal')
			.find('.modal-body')
			.empty();
	});
});
