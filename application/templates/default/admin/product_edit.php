<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#" onclick="return false">Product Edit</a>
	</div>
</div>
<?php if(isset($alert_message)){ ?>
<div class="alert <?php echo $alert_class ?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo $alert_message ?>
</div>
<?php } ?>
<form class="form-horizontal" method="POST">
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
			<li><a href="#tab2" data-toggle="tab">Link</a></li>
			<li><a href="#tab3" data-toggle="tab">Images</a></li>
		</ul>
		<div class="tab-content ">
			<div class="tab-pane active space" id="tab1">
				<div class="control-group <?php if(form_error('name')) echo "error"; ?>">
				<label class="control-label" for="inputProductName">Product Name</label>
					<div class="controls">
						<input type="text" name="name" id="inputProductName" value="<?php echo set_value('name',$product->name); ?>">
						<span class="help-inline"><?php echo form_error('name'); ?></span>
					</div>
				</div>
				<div class="control-group <?php if(form_error('price')) echo "error"; ?>">
				<label class="control-label" for="inputProductPrice">Product Price</label>
					<div class="controls">
						<input type="text" name="price" id="inputProductPrice" value="<?php echo set_value('price', $product->price); ?>">
						<span class="help-inline"><?php echo form_error('price'); ?></span>
					</div>
				</div>
				<div class="control-group <?php if(form_error('status')) echo "error"; ?>">
				<label class="control-label" for="productStatus">Product Status</label>
					<div class="controls">
						<?php echo form_dropdown('status', $status, set_value('status', $product->status), 'id="productStatus"') ?>
						<span class="help-inline"><?php echo form_error('status'); ?></span>
					</div>
				</div>
				<div class="control-group <?php if(form_error('description')) echo "error"; ?>">
				<label class="control-label" for="inputDescription">Product Description</label>
					<div class="controls">
						<textarea name="description" id="inputDescription"><?php echo set_value('description', $product->description) ?></textarea>
						<span class="help-inline"><?php echo form_error('description'); ?></span>
					</div>
				</div>
			</div><!-- End of General -->
			<div class="tab-pane space" id="tab2">
				<div class="control-group <?php if(form_error('category_id')) echo "error"; ?>">
					<label class="control-label" for="inputCategory">Category</label>
					<div class="controls">
						<?php echo form_dropdown('category_id', $categories, set_value('category_id', $product->category_id), 'id="inputCategory"') ?>
						<span class="help-inline"><?php echo form_error('category_id'); ?></span>
					</div>
				</div>
				<div class="control-group <?php if(form_error('manufacturer_id')) echo "error"; ?>">
					<label class="control-label" for="inputManufacturer">Manufacturer</label>
					<div class="controls">
						<?php echo form_dropdown('manufacturer_id', $manufacturers, set_value('manufacturer_id', $product->manufacturer_id), 'id="inputManufacturer"') ?>
						<span class="help-inline"><?php echo form_error('manufacturer_id'); ?></span>
					</div>
				</div>
			</div><!-- End of Link -->
			<div class="tab-pane space" id="tab3">
				<input id="default_image" name="default_image" type="hidden" value="<?php echo $product->default_image ?>" />
				<div id="image_container"><!-- Filled by JavaScript --></div>
				<div class="clearfix"></div>
				<a href="<?php echo base_url('/admin/product/upload_image/' . $product->product_id) ?>"
					data-toggle="modal" data-target="#image_upload" class="btn">Add Image</a>
			</div><!-- End of Images -->
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Update</button>
		<a class="btn" href="<?php echo base_url('/admin/product') ?>">Cancel</a>
	</div>
</form>

<div id="image_upload" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Upload Image</h3>
	</div>
	<div class="modal-body"></div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">Close</button>
		<button class="btn btn-primary" onclick="submit_image()">Upload</button>
	</div>
</div>
<script type="text/javascript">
	product_id = <?php echo $product->product_id ?>;
</script>
