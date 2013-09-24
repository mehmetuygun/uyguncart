$(function() {
	$('.thum-list a').on('click', function(e) {
		e.preventDefault();
		var size = $(this).data('img-md-size').split('x');
		var img_md = $(this).data('img-md');
		var img_lg = $(this).data('img-lg');
		var html = '<a href="' + img_lg + '"><img class="media-object" width="' + size[0] + '"' + 
					' height="' + size[1] + '" src="' + img_md + '" /></a>';
		$('.img-main-frame').html(html);
	});
});