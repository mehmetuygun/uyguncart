$(document).ready(function() {
	ajax('latestproduct');
});

function ajax(select) {
	$.post('home/ajax', {select: select}, display);
}

function display(data) {
	var html = '';
	var img_200_path = 'public/images/200/';
	var cart_url = base_url+'cart';

	for(var i=0;i<9;i++) {
		if (typeof data[i] == 'undefined') {
			i--;
			break;
		}
		if(i==0 || i==3 || i==6) {
			html += '<div class="row f-space">';
		}

		var p_url = base_url + 'product/id/'+ data[i].product_id;
		var img_src = base_url+'public/images/135/noimage.jpg';
		if (data[i].full_name != null) {
			img_src = base_url+img_200_path+data[i].full_name;
		}

		html += '<div class="col-lg-4">';
		html += '<div class="thumbnail">';
		html += '<a class="thumbnail" href="'+p_url+'">';
		html += '<img alt="200x150" src="'+img_src+'" /></a>';
		html += '<div class="caption">';
		html += '<h5><a href="'+p_url+'">'+data[i].name+'</a></h5>';
		html += '<h5><span class="price">$'+data[i].price+'</span></h5>';
		// html += '<form action="'+cart_url+'" method="post">';
		// html += '<input type="hidden" value="'+data[i].product_id+'" name="product_id" />';
		// html += '<button type="submit" class="btn btn-primary" style="width:100%">';
		// html += 'Add To Cart';
		// html += '</button></form>';
		html += '</div></div></div>';

		if (i==2 || i==5 || i==8) {
			html += '</div>';
		}
	}

	if (i > 0 && i!=2 && i!=5 && i!=8) {
		html += '</div>';
	}

	$('.display_products').html(html);
}
