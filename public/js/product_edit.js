tinymce.init({selector:'textarea', plugins:'table'});

$(function() {
	$('#image_upload').on('shown', function() {
		$(this).find('form').ajaxForm({
			success: function(res) {
				if (res['success']) {
					$('#image_upload').modal('hide');
					return;
				}
				for (i in res['errors']) {
					alert(res['errors'][i]);
				}
			},
			dataType: 'json'
		});
	});
});

function submit_image() {
	$('#image_upload form').submit();
}
