function pagination(page,page_count)
{
	$(".pagination").empty();
	var prev = page - 1;
	var next = page + 1;
	if(prev<1)
	    prev = 1;
	if(next>page_count)
	    next = page_count;
	var last_five = page_count - 5;
	var html = "<ul>";
	if(page == 1)
	    html += '<li class="disabled"><a href="#'+prev+'" onclick="return false">&laquo;</a></li>';
	else
	    html += '<li><a href="#'+prev+'">&laquo;</a></li>';
	if(page_count<10)
	    if(page>=1&&page<=10)
	        for (var i = 1; i <= page_count; i++) {
	            if(page==i)
	                html += '<li class="active"><a href="#'+page+'" onclick="return false">'+page+'</a></li>';
	            else
	                html += '<li><a href="#'+i+'" onclick="return false">'+i+'</a></li>';
	        }
	if(page_count>10)
	    if(page >= 1&& page<6)
	        for (var i = 1; i <= 10; i++) {
	            if(page==i)
	                html += '<li class="active"><a href="#'+page+'" onclick="return false">'+page+'</a></li>';
	            else
	                html += '<li><a href="#'+i+'" onclick="return false">'+i+'</a></li>';
	        }
	    else if(page<last_five)
	        for(i = page - 4; i <= page + 5;i++){
	            if(page==i)
	                html += '<li class="active"><a href="#'+page+'" onclick="return false">'+page+'</a></li>';
	            else
	                html += '<li><a href="#'+i+'" onclick="return false">'+i+'</a></li>';
	        }
	    else if(page>=last_five)
	        for(i = last_five - 4; i <= page_count;i++){
	            if(page==i)
	                html += '<li class="active"><a href="#'+page+'" onclick="return false">'+page+'</a></li>';
	            else
	                html += '<li><a href="#'+i+'" onclick="return false">'+i+'</a></li>';
	        }
	if(page == page_count)
	    html += '<li class="disabled"><a href="#'+next+'" onclick="return false">&raquo;</a></li>';
	else
	    html += '<li ><a href="#'+next+'" onclick="return false">&raquo;</a></li>';
	html += '</ul>';
	$(".pagination").append(html);
}