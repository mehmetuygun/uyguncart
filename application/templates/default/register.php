<div class="panel panel-primary">
	<div class="panel-heading"><h3 class="panel-title">Register</h3></div>
	<div class="panel-body">
		<h4>User register form.</h4>
		<hr>
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group <?php if(form_error('first_name')) echo "has-error"; ?>">
				<label for="inputfirstname" class="col-lg-2 control-label">First Name</label>
				<div class="col-lg-10">
					<input type="text" name="first_name" class="form-control" id="inputfirstname" placeholder="First Name" value="<?php echo set_value('first_name'); ?>">
					<span class="help-block"><?php echo form_error('first_name'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('last_name')) echo "has-error"; ?>">
				<label for="inputlastname" class="col-lg-2 control-label">Last Name</label>
				<div class="col-lg-10">
					<input type="text" name="last_name" class="form-control" id="inputlastname" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>">
					<span class="help-block"><?php echo form_error('last_name'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('email')) echo "has-error"; ?>">
				<label for="inputEmail1" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10 error">
					<input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email" value="<?php echo set_value('email'); ?>">
					<span class="help-block"><?php echo form_error('email'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('password')) echo "has-error"; ?>">
				<label for="inputPassword1" class="col-lg-2 control-label">Password</label>
				<div class="col-lg-10">
					<input type="password" name="password" class="form-control" id="inputPassword1" placeholder="Password">
					<span class="help-block"><?php echo form_error('password'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('re-password')) echo "has-error"; ?>">
				<label for="inputPassword2" class="col-lg-2 control-label">Re-password</label>
				<div class="col-lg-10">
					<input type="password" name="re-password" class="form-control" id="inputPassword2" placeholder="Re-password">
					<span class="help-block"><?php echo form_error('re-password'); ?></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn btn-default">Register</button>
				</div>
			</div>
		</form>
	</div>
</div>
