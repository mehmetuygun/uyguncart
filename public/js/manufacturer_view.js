$(document).ready(function(){

	function ajax(search,page){
	    $.ajax({
	        url: "ajax",
	        type: "POST",
	        data: {page: page,search:search},
	        dataType: "json",
	        success: function(data) {
	        },
	    });
	}

	ajax("test",1);

	$(".pagination ul li a").on('click',function(){
		var search = $('input[name="search"]').val();
		var page = $(this).attr('href').substring(1);
		alert(page);
	});

	function draw_table($table){
		$(".table tbody").empty();
	}

});