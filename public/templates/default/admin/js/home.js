$(function() {
	$('#OrderDetail').on('hidden', function() {
		$(this).removeData('modal')
			.find('.modal-body')
			.empty();
	});

	ajax();
});

function ajax() {
	$.post('order/ajax', {page:1}, function(data) {
		draw_table(data[0]);
	});
}
