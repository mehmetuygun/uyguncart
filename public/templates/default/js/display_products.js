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

function fileExists(url) {
    if(url){
        var req = new XMLHttpRequest();
        req.open('GET', url, false);
        req.send();
        return req.status==200;
    } else {
        return false;
    }
}

function ajax(select) {
	$.post('home/ajax', {select: select}, function(data) {
		display(data);
	});
}

function display(data) {
	
	var html = '';
	var img_200_path = 'public/images/200/';
	var cart_url = base_url+'cart';

	for(var i=0;i<9;i++) {
		if(i==0 || i==3 || i==6) {
			html += '<div class="row f-space">';
		}

		var p_url = base_url + 'product/id/'+ data[i].product_id;
		var img_src = base_url+'public/images/135/noimage.jpg';
		if(typeof data[i].product_full_name != 'undefined' && fileExists(img_200_path+data[i].full_name)) {
			img_src = base_url+img_200_path+data[i].full_name;
		}

		html += '<div class="col-lg-4">';
        html += '<div class="thumbnail">';
        html += '<a class="thumbnail" href="'+p_url+'">';
        html += '<img alt="200x150" src="'+img_src+'" /></a>';
        html += '<div class="caption">';
        html += '<h4><a href="'+p_url+'">'+data[i].name+'</a></h4>';
        html += '<h4><span class="price">$'+data[i].price+'</span></h4>';
        html += '<form action="'+cart_url+'" method="post">';
        html += '<input type="hidden" value="'+data[i].product_id+'" name="product_id" />';
        html += '<button type="submit" class="btn btn-danger" style="width:100%">';
        html += 'Add To Cart';
        html += '</button></form></div></div></div>';

        if (i==2 || i==5 || i==8) { 
            html += '</div>';
        }
	}

	$('.display_products').html(html);
}