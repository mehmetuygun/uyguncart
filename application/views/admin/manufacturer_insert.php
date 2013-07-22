<div class="navbar">
  	<div class="navbar-inner">
    	<a class="brand" href="#">Insert Manufacturer</a>
    	<span class="pull-right">
    		<a class="btn btn-inverse" href="<?php echo base_url('admin/manufacturer/') ?>">Back</a>
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
	<div class="control-group <?php if(form_error('manufacturer')) echo "error"; ?>">
	<label class="control-label" for="inputManufacturer">Manufacturer</label>
	<div class="controls">
			<input type="text" name="manufacturer" id="inputManufacturer" value="<?php echo set_value('manufacturer'); ?>">
        <span class="help-inline"><?php echo form_error('manufacturer'); ?></span>
	</div>
		</div>
	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Insert</button>
			<a class="btn" href="<?php echo base_url('/admin/manufacturer') ?>">Cancel</a>
	</div>
</form>