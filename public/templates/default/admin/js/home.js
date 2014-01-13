$(function(){
	ajax();
});

function ajax() {
	$.post('order/ajax', {page:1}, function(data) {
		draw_table(data[0]);
	});
}