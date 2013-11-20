<div class="panel panel-default">
	<div class="panel-body">
		<ul class="nav nav-tabs nav-justified ">
			<li><a href="<?php echo base_url('user/account') ?>">Account</a></li>
			<li><a href="<?php echo base_url('user/addresses') ?>">Addresses</a></li>
			<li class="active"><a href="#">Password</a></li>
		</ul>
		<div class="space"></div>
		<?php
		if(isset($alert_message)){
			echo '<div class="alert '.$alert_class.'">';
			echo $alert_message;
			echo '</div>';
		}
		?>
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group <?php if(form_error('password')) echo "has-error"; ?>">
				<label for="inputpassword" class="col-lg-2 control-label">Current Password</label>
				<div class="col-lg-10">
					<input type="password" name="password" class="form-control" id="inputpassword" value="<?php echo set_value('password'); ?>">
					<span class="help-block"><?php echo form_error('password'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('new-password')) echo "has-error"; ?>">
				<label for="inputnew-password" class="col-lg-2 control-label">New Password</label>
				<div class="col-lg-10">
					<input type="password" name="new-password" class="form-control" id="inputnew-password" value="<?php echo set_value('new-password'); ?>">
					<span class="help-block"><?php echo form_error('new-password'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('re-password')) echo "has-error"; ?>">
				<label for="inputre-password1" class="col-lg-2 control-label">Re-password</label>
				<div class="col-lg-10 error">
					<input type="password" name="re-password" class="form-control" id="inputre-password1" value="<?php echo set_value('re-password'); ?>">
					<span class="help-block"><?php echo form_error('re-password'); ?></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn btn-primary">Save Changes</button>
				</div>
			</div>
		</form>
	</div>
</div>
