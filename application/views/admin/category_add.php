<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#" onclick="return false">Add Category</a>
	</div>
</div>
<form class="form-horizontal" method="POST" action="">
	<?php if(isset($alert_message)){ ?>
	<div class="alert <?php echo $alert_class ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $alert_message ?>
	</div>
	<?php } ?>
	<div class="control-group">
		<label class="control-label" for="inputCategory">Parent Category</label>
		<div class="controls">
			<?php echo form_dropdown('parentID', $categories, set_value('parentID', '')) ?>
			<span class="help-inline"><?php echo form_error('parentID'); ?></span>
		</div>
	</div>
	<div class="control-group <?php if(form_error('categoryName')) echo "error"; ?>">
		<label class="control-label" for="inputCategory">Category</label>
		<div class="controls">
			<input type="text" name="categoryName" id="inputCategory" value="<?php echo set_value('categoryName'); ?>">
			<span class="help-inline"><?php echo form_error('categoryName'); ?></span>
		</div>
	</div>
	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Add</button>
			<a class="btn" href="<?php echo base_url('/admin/category') ?>">Cancel</a>
	</div>
</form>
