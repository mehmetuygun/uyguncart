$(document).ready(function(){

	function ajax(search,page)
	{
		$.ajax({
			url: "ajax",
			type: "POST",
			data: {page: page,search:search},
			dataType: "json",
			success: function(data) {
				draw_table(data[0]);
				draw_page(data[1]);
			},
		});
	}

	$(".pagination ul li a").on('click',function(){
		var search = $('input[name="search"]').val();
		var page = $(this).attr('href').substring(1);
		ajax(search,page);
	});

	$('input[name="search"]').on('input',function(){
		var search = $('input[name="search"]').val();
		ajax(search,1);
	});

	function draw_table(data)
	{
		var html = "";
		for(i in data)
		{	
			html += '<tr>';
			html += '<td><input type="checkbox" value="'+data[i]['manufacturerID']+'" class="check"></td>';
			html += '<td>'+data[i]['manufacturerName']+'</td>';
			html += '<td><a class="link" href="edit/'+data[i]['manufacturerID']+'">Edit</a></td>';
			html += '</tr>';
		}
		$(".table tbody").empty();
		$(".table tbody").append(html);
	}

	function draw_page(data)
	{
		pagination(data[1],data[0]);
		$(".pagination ul li a").on('click',function(){
			var search = $('input[name="search"]').val();
			var page = $(this).attr('href').substring(1);
			ajax(search,page);
		});
	}

    $("#delete").click(function(){
        var checkboxValues = [];
        $('.table tr td input[type="checkbox"]:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });
        alert(checkboxValues);
	    if(checkboxValues.length==0)
	        alert('Please, select manufacturer you want to delete.');
	    else
	        var answer = confirm('Are sure you want to delete ?');
	        if (answer){
	            $.ajax({
	                url: "delete",
	                type: "POST",
	                data: { list: checkboxValues },
	                success: function() {
	                    ajax("",1);
	                },
	            });
	        }
    });
});

function check_all(elem)
{
	if(elem.checked)
		$('.check').prop('checked', true);
	else
		$('.check').prop('checked', false);
}
