<div class="row">
	<div class="col-lg-3">
		<div class="well well-lg">
			<h4>Categories</h4>
			<ul class="list-unstyled">
			<?php
			foreach ($categories as $cat) {
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
				<div class="btn-group" data-toggle="buttons" id="option_product">
					<label class="btn btn-primary active" val="latest" id="sadasd">
						<input type="radio" name="options" value="test"> Latest
					</label>
					<label class="btn btn-primary" val="bestseller">
						<input type="radio" name="options"> Best Seller
					</label>
				</div>
				<div class="display_products">
				</div>
			</div>
		</div>
	</div>
</div>
