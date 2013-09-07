<div class="panel">
	<div class="panel-body">
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
					);
				}
				?>
				<div class="img-main-frame">
					<?php
					$img = $images[0]['image_300'];
					echo '<img class="media-object" width="'.$img['width'].'"',
						' height="'.$img['height'].'" src="'.base_url($img['path']).'" />';
					?>
				</div>
				<div class="thum">
					<ul class="thum-list">
						<?php
						foreach ($images as $img) {
							$thumb = $img['image_64'];
							echo '<li><img class="media-object frame active"',
								' width="'.$thumb['width'].'" height="'.$thumb['height'].'"',
								' src="'.base_url($thumb['path']).'"/></li>';
						}
						?>
					</ul>
				</div>
			</div>
			<div class="col-sm-6">
				<h3 class="media-heading">
					<?php echo $row->productName ?>
				</h3>
				<table class="table">
					<tbody>
						<tr>
							<td>Rating</td>
							<td></td>
						</tr>
						<tr>
							<td>Price:</td>
							<td><span class="price">$<?php echo $row->productPrice; ?></span></td>
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
					<input type="hidden" name="productID" value="<?php echo $row->productID; ?>">
					<button type="submit" class="btn btn-primary pull-right">Add to Cart</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="tabbable" style="margin-bottom: 18px;">
	<ul class="nav nav-pills nav-justified tab-style">
		<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
		<li class=""><a href="#tab2" data-toggle="tab">Comment</a></li>
	</ul>
	<div class="tab-content tab-content-style" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
		<div class="tab-pane active" id="tab1">
			<?php echo $row->productDescription; ?>
		</div>
		<div class="tab-pane" id="tab2">
			<p>Howdy, I'm in Section 2.</p>
		</div>
	</div>
</div>
