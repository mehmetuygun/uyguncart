<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">Setting</a>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<?php $this->load->view('admin/setting_navs') ?>
	</div>
	<div class="span9">
		<form class="form-horizontal" method="POST" action="">
			<legend>Account</legend>
			<?php if(isset($alert_message)){ ?>
			<div class="alert <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $alert_message ?>
			</div>
			<?php } ?>
			<div class="control-group <?php if(form_error('email')) echo "error"; ?>">
				<label class="control-label" for="inputEmail">Email</label>
				<div class="controls">
					<input type="text" name="email" id="inputEmail" value="<?php echo set_value('email', $userEmail); ?>">
					<span class="help-inline"><?php echo form_error('email'); ?></span>
				</div>
			</div>
			<div class="control-group <?php if(form_error('fname')) echo "error"; ?>">
				<label class="control-label" for="inputFirstName">First Name</label>
				<div class="controls">
					<input type="text" name="fname" id="inputFirstName" value="<?php echo set_value('fname', $userFirstName); ?>">
					<span class="help-inline"><?php echo form_error('fname'); ?></span>
				</div>
			</div>
			<div class="control-group <?php if(form_error('lname')) echo "error"; ?>">
				<label class="control-label" for="inputLastName">Last Name</label>
				<div class="controls">
					<input type="text" name="lname" id="inputLastName" value="<?php echo set_value('lname', $userLastName); ?>">
					<span class="help-inline"><?php echo form_error('lname'); ?></span>
				</div>
			</div>
			<hr>
			<div class="control-group <?php if(form_error('pwd')) echo "error"; ?>">
				<label class="control-label" for="inputPassword">Password</label>
				<div class="controls">
					<input type="password" name="pwd" id="inputPassword" >
					<span class="help-inline"><?php echo form_error('pwd'); ?></span>
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