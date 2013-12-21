<div class="row">
	<div class="col-lg-3">
		<div class="well well-lg">
			<h4>Categories</h4>
			<ul class="list-unstyled">
			<?php
			$cat_list = isset($categories['']) ? $categories[''] : array();
			foreach ($cat_list as $cat) {
				echo '<li><a href="#" onclick="change_filter(\'cid\', ', $cat['category_id'], ', true); return false">', $cat['name'], '</a></li>';
			}
			?>
			</ul>
		</div>
		<form id="filter_form" method="get" action="<?php echo base_url('search') ?>">
			<input name="q" type="hidden" value="" />
			<input name="cid" type="hidden" value="" />
		</form>
	</div>
	<div class="col-lg-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-xs-4">
					<select class="form-control" id="option_product">
						<option value="latestproduct">Latest Products</option>
					</select>
				</div>
				<div class="display_products">
				</div>
			</div>
		</div>
	</div>
</div>
