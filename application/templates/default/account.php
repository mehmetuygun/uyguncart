<div class="panel panel-default">
	<div class="panel-body">
		<ul class="nav nav-tabs nav-justified ">
			<li class="active"><a href="#">Account</a></li>
			<li><a href="<?php echo base_url('user/addresses') ?>">Addresses</a></li>
			<li><a href="<?php echo base_url('user/password')?>">Password</a></li>
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
			<div class="form-group <?php if(form_error('email')) echo "has-error"; ?>">
				<label for="inputEmail1" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10 error">
					<input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email" value="<?php echo set_value('email', $userEmail); ?>">
					<span class="help-block"><?php echo form_error('email'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('firstname')) echo "has-error"; ?>">
				<label for="inputfirstname" class="col-lg-2 control-label">First Name</label>
				<div class="col-lg-10">
					<input type="text" name="firstname" class="form-control" id="inputfirstname" placeholder="First Name" value="<?php echo set_value('firstname', $userFirstName); ?>">
					<span class="help-block"><?php echo form_error('firstname'); ?></span>
				</div>
			</div>
			<div class="form-group <?php if(form_error('lastname')) echo "has-error"; ?>">
				<label for="inputlastname" class="col-lg-2 control-label">Last Name</label>
				<div class="col-lg-10">
					<input type="text" name="lastname" class="form-control" id="inputlastname" placeholder="Last Name" value="<?php echo set_value('lastname', $userLastName); ?>">
					<span class="help-block"><?php echo form_error('lastname'); ?></span>
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
