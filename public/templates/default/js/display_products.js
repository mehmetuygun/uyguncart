$( document ).ready(function(){

	$("#option_product").change(function(){
		select_mode();
		ajax(select);
	});

	select_mode();
	ajax(select);

});

var select;

function select_mode() {
	select = $( "#option_product" ).val();
	return select;
}

function ajax(select) {
	$.post('home/ajax', {select: select}, function(data) {
		alert(data);
	});
}

function display(data) {
	
}