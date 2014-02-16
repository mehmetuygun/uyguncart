<ul class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Home</a><span class="divider"></span></li>
	<li class="active">Search</li>
</ul>
<div class="row">
	<div class="col-lg-3">
		<div class="well well-lg">
			<h4>Category</h4>
			<ul class="list-unstyled">
			<?php
			if(isset($subcategory)) {
				if(isset($cid) && $cid == $subcategory['category_id'])
					echo '<li class="active"><a href="#" onclick="change_filter(\'cid\', ', $subcategory['category_id'], ', true); return false">', $subcategory['name'], '</a></li>';
				else 
					echo '<li><a href="#" onclick="change_filter(\'cid\', ', $subcategory['category_id'], ', true); return false">', $subcategory['name'], '</a></li>';
				echo '<ul class="ul-sb">';
			}

			foreach ($categories as $cat) {
				if(isset($cid) && $cid == $cat['category_id'])
					echo '<li class="active"><a href="#" onclick="change_filter(\'cid\', ', $cat['category_id'], ', true); return false">', $cat['name'], '</a></li>';
				else 
					echo '<li><a href="#" onclick="change_filter(\'cid\', ', $cat['category_id'], ', true); return false">', $cat['name'], '</a></li>';
			}

			if(isset($subcategory)) {
				echo '</ul>';
			}
			?>
			</ul>
		</div>
		<form id="filter_form" method="get" action="">
			<input name="q" type="hidden" value="<?php echo $q ?>" />
			<input name="orderby" type="hidden" value="<?php echo $orderby ?>" />
			<input name="page" type="hidden" value="<?php echo $page ?>" />
			<input name="cid" type="hidden" value="<?php echo $cid ?>" />
		</form>
	</div>
	<div class="col-lg-9">
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
			if (!$products) {
			?>
				<div class="alert alert-warning">
					No results found related with <strong>&apos;<?php echo $q ?>&apos;</strong>
				</div>
				<h4>Suggestion</h4>
				<ul>
					<li>Make sure that all words are spelled correctly.</li>
					<li>Try searching with different words.</li>
				</ul>
			<?php
			} else if (!$q && !$cid) {
			?>
				<div class="alert alert-warning">
					You tried to search with empty input.
				</div>
				<h4>Suggestion</h4>
				<ul>
					<li>Enter at least one character into the search box.</li>
				</ul>
			<?php
			} else {
			?>
				<div class="alert alert-warning" style="margin-bottom:0">
					<strong><?php echo $entries ?></strong> products are found for <strong>&apos;<?php echo $q ?>&apos;</strong>.
				</div>
				<div class="pull-left pagination">
					<form method="GET" action="" class="form-inline" role="form">
						<input name="q" type="hidden" value="<?php echo $q; ?>">
						<div class="form-group">
							<select class="form-control input-xs col-xs-3" name="orderby">
								<option value="name"<?php if ($orderby == 'name') echo ' selected="selected"' ?>>Name</option>
								<option value="price_asc"<?php if ($orderby == 'price_asc') echo ' selected="selected"' ?>>Price - Ascending</option>
								<option value="price_desc"<?php if ($orderby == 'price_desc') echo ' selected="selected"' ?>>Price - Descending</option>
							</select>
						</div>
						<input name="page" type="hidden" value="<?php echo $page ?>">
						<input name="cid" type="hidden" value="<?php echo $cid ?>">
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

						$format_price = number_format($row['price'], 2);
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
								<span class="price">\${$format_price}</span>
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
								<option value="price_asc"<?php if ($orderby == 'price_asc') echo ' selected="selected"' ?>>Price - Ascending</option>
								<option value="price_desc"<?php if ($orderby == 'price_desc') echo ' selected="selected"' ?>>Price - Descending</option>

							</select>
						</div>
						<input name="page" type="hidden" value="<?php echo $page ?>">
						<button type="submit" class="btn btn-default">Sort</button>
					</form>
				</div>
				<?php echo $pagination; ?>
				<div class="clearfix"></div>
			<?php
			}
			?>
			</div>
		</div>
	</div>
</div>
