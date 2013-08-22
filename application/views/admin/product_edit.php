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
				<div class="control-group <?php if(form_error('productName')) echo "error"; ?>">
				<label class="control-label" for="inputProductName">Product Name</label>
				   <div class="controls">
						<input type="text" name="productName" id="inputProductName" value="<?php echo set_value('productName',$product->productName); ?>">
						<span class="help-inline"><?php echo form_error('productName'); ?></span>
				   </div>
				</div>
				<div class="control-group <?php if(form_error('productPrice')) echo "error"; ?>">
				<label class="control-label" for="inputProductPrice">Product Price</label>
				   <div class="controls">
						<input type="text" name="productPrice" id="inputProductPrice" value="<?php echo set_value('productPrice', $product->productPrice); ?>">
						<span class="help-inline"><?php echo form_error('productPrice'); ?></span>
				   </div>
				</div>
				<div class="control-group <?php if(form_error('productStatus')) echo "error"; ?>">
				<label class="control-label" for="productStatus">Product Status</label>
				   <div class="controls">
				   	<?php var_dump($product->productStatus, set_value('productStatus', '')) ?>
						<?php echo form_dropdown('productStatus', $status, set_value('productStatus', $product->productStatus), 'id="productStatus"') ?>
						<span class="help-inline"><?php echo form_error('productStatus'); ?></span>
				   </div>
				</div>
				<div class="control-group <?php if(form_error('productDescription')) echo "error"; ?>">
				<label class="control-label" for="inputProductName">Product Description</label>
				   <div class="controls">
						<textarea name="productDescription"><?php echo set_value('productDescription', $product->productDescription) ?></textarea>
						<span class="help-inline"><?php echo form_error('productDescription'); ?></span>
				   </div>
				</div>
			</div><!-- End of General -->
			<div class="tab-pane space" id="tab2">
				<div class="control-group <?php if(form_error('categoryID')) echo "error"; ?>">
					<label class="control-label" for="inputCategory">Category</label>
					<div class="controls">
						<?php echo form_dropdown('categoryID', $categories, set_value('categoryID', $product->categoryID), 'id="inputCategory"') ?>
						<span class="help-inline"><?php echo form_error('categoryID'); ?></span>
					</div>
				</div>
				<div class="control-group <?php if(form_error('manufacturerID')) echo "error"; ?>">
					<label class="control-label" for="inputManufacturer">Manufacturer</label>
					<div class="controls">
						<?php echo form_dropdown('manufacturerID', $manufacturers, set_value('manufacturerID', $product->manufacturerID), 'id="inputManufacturer"') ?>
						<span class="help-inline"><?php echo form_error('manufacturerID'); ?></span>
					</div>
				</div>
			</div><!-- End of Link -->
			<div class="tab-pane space" id="tab3">
				<input id="defaultImage" name="defaultImage" type="hidden" value="<?php echo $product->defaultImage ?>" />
				<div id="image_container"><!-- Filled by JavaScript --></div>
				<div class="clearfix"></div>
				<a href="<?php echo base_url('/admin/product/upload_image/' . $product->productID) ?>"
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
	product_id = <?php echo $product->productID ?>;
</script>
