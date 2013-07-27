<div class="navbar">
  	<div class="navbar-inner">
    	<a class="brand" href="#">Add Product</a>
    	<span class="pull-right">
    		<a class="btn btn-inverse" href="<?php echo base_url('admin/product/') ?>">Back</a>
    	</span>
  	</div>
</div>
<form class="form-horizontal" method="POST" action="">
    <?php if(isset($alert_message)){ ?>
    <div class="alert <?php echo $alert_class ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $alert_message ?>
    </div>
    <?php } ?>
	<div class="control-group <?php if(form_error('productName')) echo "error"; ?>">
	<label class="control-label" for="inputProductName">Product Name</label>
	   <div class="controls">
			<input type="text" name="productName" id="inputProductName" value="<?php echo set_value('productName'); ?>">
            <span class="help-inline"><?php echo form_error('productName'); ?></span>
	   </div>
	</div>
    <div class="control-group">
        <label class="control-label">Category</label>
        <div class="controls">
            <?php echo form_dropdown('categoryID', $categories, set_value('categoryID', '')) ?>
            <span class="help-inline"><?php echo form_error('categoryID'); ?></span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Manufacturer</label>
        <div class="controls">
            <?php echo form_dropdown('manufacturerID', $manufacturer, set_value('manufacturerID', '')) ?>
            <span class="help-inline"><?php echo form_error('manufacturerID'); ?></span>
        </div>
    </div>
	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Create</button>
			<a class="btn" href="<?php echo base_url('/admin/product') ?>">Cancel</a>
	</div>
</form>