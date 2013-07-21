$(document).ready(function(){

	function ajax(search,page){
	    $.ajax({
	        url: "ajax/ajax.category.php",
	        type: "GET",
	        data: {page: page},
	        success: function(data) {
	            var x = eval('(' + data + ')');
	            drawTable(x);
	            drawPage(x.p.total_page,x.p.currentpage);
	            if(mode!='notclist')
	                clist(x);
	        },
	    });
	}
	ajax();
	$(".pagination ul li a").on('click',function(){
		var search = $('input[name="search"]').val();
		var page = $(this).attr('href').substring(1);
		alert(page);
	});

});