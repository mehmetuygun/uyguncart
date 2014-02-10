<ol class="breadcrumb">
	<li><a href="#">Home</a></li>
<?php
$cat_array = explode(' / ', $cat_path);
for($i=0;$i<count($cat_array);$i++) {
	if($i==count($cat_array)-1) {
		echo '<li class="active">'.$cat_array[$i].'</li>'; 
	} else {
		echo '<li><a href="#">'.$cat_array[$i].'</a></li>';
	}
}
?>
</ol>
<div class="panel panel-default" id="product_detail_header">
	<div class="panel-body">
		<h3 class="media-heading">
			<?php echo $row->name ?>
		</h3>
		<div class="row">
			<div class="col-sm-4">
				<?php
				if (empty($images)) {
					$images[0] = array(
						'image_64' => array(
							'path' => '/public/images/135/noimage.jpg',
							'width' => '64',
							'height' => '64',
						),
						'image_300' => array(
							'path' => '/public/images/135/noimage.jpg',
							'width' => '135',
							'height' => '135',
						),
						'image_500' => array(
							'path' => '/public/images/135/noimage.jpg',
							'width' => '135',
							'height' => '135',
						),
					);
				}
				?>
				<div class="img-main-frame">
					<?php
					$img = $images[0]['image_300'];
					$lg_img = base_url($images[0]['image_500']['path']);

					echo '<a href="'.$lg_img.'"><img class="media-object" width="'.$img['width'].'"',
						' height="'.$img['height'].'" src="'.base_url($img['path']).'" /></a>';
					?>
				</div>
				<div class="thum">
					<ul class="thum-list">
						<?php
						foreach ($images as $img) {
							$thumb = $img['image_64'];
							$md_img = base_url($img['image_300']['path']);
							$md_size = $img['image_300']['width'] . 'x' . $img['image_300']['height'];
							$lg_img = base_url($img['image_500']['path']);
							// $lg_size = $img['image_500']['width'] . 'x' . $img['image_500']['height'];
							echo '<li><a href="'.$lg_img.'" data-img-md="'.$md_img.'" data-img-lg="'.$lg_img.'"',
								' data-img-md-size="'.$md_size.'">',
								' <img class="media-object frame active"',
								' width="'.$thumb['width'].'" height="'.$thumb['height'].'"',
								' src="'.base_url($thumb['path']).'"/></a></li>';
						}
						?>
					</ul>
				</div>
			</div>
			<div class="col-sm-6">
				<table class="table">
					<tbody>
						<tr>
							<td>Price:</td>
							<td><span class="price">$<?php echo number_format($row->price, 2); ?></span></td>
						</tr>
						<tr>
							<td>Share on</td>
							<td>Facebook, G+, Twitter</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-2">
				<form method="post" action="<?php echo base_url('cart'); ?>">
					<input type="hidden" name="product_id" value="<?php echo $row->product_id; ?>">
					<button type="submit" class="btn btn-primary pull-right">Add to Cart</button>
				</form>
			</div>
		</div>
	</div>
</div>
<ul id="myTab" class="nav nav-tabs">
	<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
	<li class=""><a href="#comment" data-toggle="tab">Comment</a></li>
</ul>
<div id="product-detail" class="tab-content">
	<div class="tab-pane fade active in" id="description">
		<?php echo $row->description; ?>
	</div>
	<div class="tab-pane fade" id="comment">
		<p>The comment is disabled.</p>
	</div>
</div>
