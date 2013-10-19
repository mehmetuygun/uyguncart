<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">User</a>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<?php $this->load->view('admin/user_navs') ?>
	</div>
	<div class="span9">
		<form class="form-horizontal" method="POST" action="">
			<legend>Password</legend>
			<?php if(isset($alert_message)){ ?>
			<div class="alert <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $alert_message ?>
			</div>
			<?php } ?>
			<div class="control-group <?php if(form_error('current_password')) echo "error"; ?>">
				<label class="control-label" for="inputPassword">Current Password</label>
				<div class="controls">
					<input type="password" name="current_password" id="inputPassword">
					<span class="help-inline"><?php echo form_error('current_password'); ?></span>
				</div>
			</div>
			<div class="control-group <?php if(form_error('new_password')) echo "error"; ?>">
				<label class="control-label" for="inputNewPassword">New Password</label>
				<div class="controls">
					<input type="password" name="new_password" id="inputNewPassword">
					<span class="help-inline"><?php echo form_error('new_password'); ?></span>
				</div>
			</div>
			<div class="control-group <?php if(form_error('confirm_password')) echo "error"; ?>">
				<label class="control-label" for="inputConfirmPassword">Confirm Passwword</label>
				<div class="controls">
					<input type="password" name="confirm_password" id="inputConfirmPassword">
					<span class="help-inline"><?php echo form_error('confirm_password'); ?></span>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<a class="btn" href="<?php echo base_url('/admin/home') ?>">Cancel</a>
			</div>
		</form>
	</div>
</div>
<hr>
