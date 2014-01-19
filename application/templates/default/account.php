<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<a href="<?php echo base_url('user/account')?>" class="list-group-item active">Account</a>
			<a href="<?php echo base_url('address')?>" class="list-group-item">Address</a>
			<a href="<?php echo base_url('user/password')?>" class="list-group-item">Password</a>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-body">
  				<h3>Account <small>Change basic account information.</small></h3>
  				<hr>
				<div class="space"></div>
				<?php
				if(isset($alert_message)){
					echo '<div class="alert '.$alert_class.'">';
					echo $alert_message;
					echo '</div>';
				}
				?>
				<form class="form-horizontal" role="form" method="POST" action="">
					<div class="form-group <?php if(form_error('email')) echo "has-error"; ?>">
						<label for="inputEmail1" class="col-lg-2 control-label">Email</label>
						<div class="col-lg-10 error">
							<input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email" value="<?php echo set_value('email', $userEmail); ?>">
							<span class="help-block"><?php echo form_error('email'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if(form_error('first_name')) echo "has-error"; ?>">
						<label for="inputfirstname" class="col-lg-2 control-label">First Name</label>
						<div class="col-lg-10">
							<input type="text" name="first_name" class="form-control" id="inputfirstname" placeholder="First Name" value="<?php echo set_value('first_name', $userFirstName); ?>">
							<span class="help-block"><?php echo form_error('first_name'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if(form_error('last_name')) echo "has-error"; ?>">
						<label for="inputlastname" class="col-lg-2 control-label">Last Name</label>
						<div class="col-lg-10">
							<input type="text" name="last_name" class="form-control" id="inputlastname" placeholder="Last Name" value="<?php echo set_value('last_name', $userLastName); ?>">
							<span class="help-block"><?php echo form_error('last_name'); ?></span>
						</div>
					</div>
					<hr>
					<div class="form-group <?php if(form_error('password')) echo "has-error"; ?>">
						<label for="inputPassword1" class="col-lg-2 control-label">Password</label>
						<div class="col-lg-10">
							<input type="password" name="password" class="form-control" id="inputPassword1" placeholder="Password">
							<span class="help-block"><?php echo form_error('password'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-default">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
