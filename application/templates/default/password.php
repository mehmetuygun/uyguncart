<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<a href="<?php echo base_url('user/account')?>" class="list-group-item">Account</a>
			<a href="<?php echo base_url('address')?>" class="list-group-item">Address</a>
			<a href="<?php echo base_url('user/password')?>" class="list-group-item active">Password</a>
			<a href="<?php echo base_url('orders')?>" class="list-group-item">Orders</a>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Password <small>Change password.</small></h3>
				<hr>
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
						<label for="inputre-password1" class="col-lg-2 control-label">Re-enter New Password</label>
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
	</div>
</div>
