$( document ).ready(function(){

	var base_url = $("#base_url").val();

	$("#option_product").change(function(){
		select_mode();
		ajax(select);
	});

	select_mode();
	ajax(select);

});

var select;
var base_url = $("#base_url").val();

function select_mode() {
	base_url = $("#base_url").val();
	select = $( "#option_product" ).val();
	return select;
}

function ajax(select) {
	$.post('home/ajax', {select: select}, function(data) {
		display(data);
	});
}

function display(data) {
	
	var html;

	html += '<div class="row f-space">';

	alert(data[1].product_id);

	html += '</div>';
}