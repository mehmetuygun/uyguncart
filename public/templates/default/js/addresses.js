$( document ).ready(function() {
 	ajax();
});

function ajax() {
	$.post('get_address', function(data) {
		draw_table(data);
	});
}

function draw_table() {
	html = '<tr><td colspan="3">No registered address.</td></tr>';
	$('#address_table tbody').html(html);
}