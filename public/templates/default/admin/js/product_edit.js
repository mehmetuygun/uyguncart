tinymce.init({selector:'textarea', plugins:'table'});

$(function() {
	$('#image_upload').on('shown', function() {
		$(this).find('form').ajaxForm({
			success: function(res) {
				if (res['success']) {
					$('#image_upload').modal('hide');
					get_images();
					return;
				}
				for (i in res['errors']) {
					alert(res['errors'][i]);
				}
			}
		});
	});
	$('a[href=#tab3]').on('shown', get_images);
});

function get_images() {
	var url = base_url + 'admin/product/get_images/' + product_id;
	$.get(url, function(res) {
		$('#image_container').empty();
		for (var i = 0; i < res.length; i++) {
			var html = '', set_default, outer_class = '';
			var med_info = res[i]['image_200'];
			var img_med = base_url + med_info['path'];
			var img_lrg = base_url + res[i]['image_500']['path'];
			var del_image = ' onclick="delete_image(' + res[i]['image_id'] + ')"';
			var w_h = ' width="' + med_info['width'] + 'px" height="' + med_info['height'] + 'px"';
			if (res[i]['default']) {
				outer_class = ' img-default';
				set_default = ' disabled="disabled"';
			} else {
				set_default = ' onclick="$(\'#default_image\').val(' + res[i]['image_id'] + ')"';
			}

			html += '<div class="img-outer' + outer_class + '">';
			html += '<div class="img-inner">';
			html += '<a href="' + img_lrg + '" target="_blank" title="See full size">';
			html += '<img src="' + img_med + '" ' + w_h + ' /></a></div>';
			html += '<div class="img-content">';
			html += '<button type="button" class="btn btn-info pull-left"' + set_default + '>Set as default</button>';
			html += '<button type="button" class="btn btn-danger pull-right" ' + del_image + '">Delete</button>';
			html += '</div></div>';

			$('#image_container').append(html);
		}
	});
}

function submit_image() {
	$('#image_upload form').submit();
}

function delete_image(image_id) {
	if (!confirm('Are you sure you want to delete this image?')) {
		return;
	}

	var url = base_url + 'admin/product/delete_image/' + image_id;
	$.get(url, get_images);
}

