<ul class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Home</a><span class="divider"></span></li>
	<li class="active">Search</li>
</ul>
<?php
if(empty($products)) {
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Search</h3>
	</div>
	<div class="panel-body">
		<div class="alert alert-warning">
			<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
			No result found related with <strong><?php echo $q ?></strong>
		</div>
		<h4>Suggestion</h4>
		<ul>
			<li>Make sure the word is correct.</li>
			<li>Try to search with similar word.</li>
		</ul>
	</div>
</div>
<?php
} else if(empty($_GET['q'])) {
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Search</h3>
	</div>
	<div class="panel-body">
		<div class="alert alert-warning">
			<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
			You tried to search with empty input.
		</div>
		<h4>Suggestion</h4>
		<ul>
			<li>Make sure the word is entered.</li>
		</ul>
	</div>
</div>
<?php
} else {
	?>
	<div class="row">
		<div class="col-lg-3">
			<div class="category">
			<div class="head">Category</div>
				<ul class="nav">
				<?php
				$cat_list = isset($categories['']) ? $categories[''] : array();
				foreach ($cat_list as $cat) {
					echo '<li><a href="#">', $cat['name'], '</a></li>';
				}
				?>
				</ul>
			</div>
		</div>
		<div class="col-lg-9">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="alert alert-warning" style="margin-bottom:0">
						<strong><?php echo $entries ?></strong> products are found for <strong><?php echo $q ?></strong>.
					</div>
					<div class="pull-left pagination">
						<form method="GET" action="" class="form-inline" role="form">
							<input name="q" type="hidden" value="<?php echo $q; ?>">
							<div class="form-group">
								<select class="form-control input-xs col-xs-3" name="orderby">
									<option value="name"<?php if ($orderby == 'name') echo ' selected="selected"' ?>>Name</option>
									<option value="price"<?php if ($orderby == 'price') echo ' selected="selected"' ?>>Price</option>
								</select>
							</div>
							<input name="page" type="hidden" value="<?php echo $page ?>">
							<button type="submit" class="btn btn-default">Sort</button>
						</form>

					</div>
					<?php echo $pagination; ?>
					<div class="clearfix"></div>
					<div class="result-body">
						<?php
						$img_135_url = base_url('public/images/135') . '/';
						foreach ($products as $row) {
							$product_url = base_url('product/id/' . $row['product_id']);
							$img_src = $img_135_url . 'noimage.jpg';
							if (!is_null($row['full_name']) && file_exists('public/images/135/'.$row['full_name'])) {
								$img_src = $img_135_url . $row['full_name'];
							}

							echo <<<HTML
							<div class="media">
								<a class="pull-left" href="{$product_url}">
									<div class="img-frame x135">
										<img class="media-object" src="{$img_src}" />
									</div>
								</a>
								<div class="media-body">
									<h4 class="media-heading">
										<a href="{$product_url}">{$row['name']}</a>
									</h4>
									<span class="price">\${$row['price']}</span>
								</div>
							</div>
HTML;
						}
						?>
					</div>
					<div class="pull-left pagination">
						<form method="GET" action="" class="form-inline" role="form">
							<input name="q" type="hidden" value="<?php echo $q ?>">
							<div class="form-group">
								<select class="form-control input-xs col-xs-3" name="orderby">
									<option value="name"<?php if ($orderby == 'name') echo ' selected="selected"' ?>>Name</option>
									<option value="price"<?php if ($orderby == 'price') echo ' selected="selected"' ?>>Price</option>
								</select>
							</div>
							<input name="page" type="hidden" value="<?php echo $page ?>">
							<button type="submit" class="btn btn-default">Sort</button>
						</form>
					</div>
					<?php echo $pagination; ?>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
