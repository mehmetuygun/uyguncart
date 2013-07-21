<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap-responsive.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/style.css');?>">
	</head>
	<body>
		<div id="wrap">
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container-fluid">
						<a class="brand" href="<?php echo base_url('admin/home'); ?>">UygunCart</a>
						<ul class="nav">
							<li class="<?php if(isset($menu_active)&&$menu_active=="home")echo 'active'; ?>"><a href="<?php echo base_url('admin/home'); ?>">Home</a></li>
							<li class="dropdown <?php if(isset($menu_active)&&$menu_active=="catalog")echo 'active'; ?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalog <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url('admin/category'); ?>">Categories</a></li>
									<li><a href="<?php echo base_url('admin/category'); ?>">Products</a></li>
									<li><a href="<?php echo base_url('admin/manufacturer'); ?>">Manufacturers</a></li>
								</ul>
							</li>
							<li class="dropdown <?php if(isset($menu_active)&&$menu_active=="sales")echo 'active'; ?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sales <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url('admin/category'); ?>">Order</a></li>
								</ul>
							</li>
							<li class="dropdown <?php if(isset($menu_active)&&$menu_active=="system")echo 'active'; ?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url('admin/category'); ?>">Payment Setting</a></li>
								</ul>
							</li>
						</ul>
						<div class="btn-group pull-right">
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="icon-user"></span>&nbsp;<?php echo $fullname;?>&nbsp;<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('admin/setting'); ?>">Settings</a></li>
								<li class="divider"></li>
								<li> <a href="<?php echo base_url('admin/logout'); ?>">Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid" style="padding-top:60px">