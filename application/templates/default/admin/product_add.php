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
	<div class="control-group <?php if(form_error('name')) echo "error"; ?>">
	<label class="control-label" for="inputProductName">Product Name</label>
	   <div class="controls">
			<input type="text" name="name" id="inputProductName" value="<?php echo set_value('name'); ?>">
            <span class="help-inline"><?php echo form_error('name'); ?></span>
	   </div>
	</div>
    <div class="control-group">
        <label class="control-label">Category</label>
        <div class="controls">
            <?php echo form_dropdown('category_id', $categories, set_value('category_id', '')) ?>
            <span class="help-inline"><?php echo form_error('category_id'); ?></span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Manufacturer</label>
        <div class="controls">
            <?php echo form_dropdown('manufacturer_id', $manufacturer, set_value('manufacturer_id', '')) ?>
            <span class="help-inline"><?php echo form_error('manufacturer_id'); ?></span>
        </div>
    </div>
	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Create</button>
			<a class="btn" href="<?php echo base_url('/admin/product') ?>">Cancel</a>
	</div>
</form>