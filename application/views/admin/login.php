<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap-responsive.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/login.css');?>">
	</head>
	<body>
		<div class="login-box">
			<div class="login-title">
				<span>LOGIN</span>
				<a class="btn btn-mini btn-inverse pull-right" href="<?php echo base_url();?>">Home</a>
			</div>
			<?php
			if(isset($alert)){
			?>
			<div class="alert <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $message ?>
			</div>
			<?php
			}
			?>
			<form class="form-horizontal" method="post" action="">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input type="text" name="email" id="inputEmail" placeholder="Email" >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<input type="password" name="password" id="inputPassword" placeholder="Password" >
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" name="submit_form" class="btn btn-success">Log in</button>
				</div>
			</form>
		</div>
		<script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.10.2.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js');?>"></script>
	</body>
</html>
