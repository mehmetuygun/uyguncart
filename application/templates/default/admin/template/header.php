<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/templates/default/admin/css/bootstrap-responsive.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/templates/default/admin/css/bootstrap.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/templates/default/admin/css/style.css');?>">
	</head>
	<body>
		<div id="wrap">
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container-fluid">
						<a class="brand" href="<?php echo base_url('admin/home'); ?>">UygunCart</a>
						<ul class="nav">
						<?php
						foreach ($nav_menu as $menu => $item) {
							$class_def = '';
							$item_name = $item['name'];
							if (isset($item['sub'])) {
								$item_name .= ' <i class="caret"></i>';
								$class_def .= ' dropdown';
								$anchor_attrs = ' href="#" class="dropdown-toggle" data-toggle="dropdown"';
							} else {
								$anchor_attrs = ' href="' . base_url($item['url']) . '"';
							}
							if (isset($menu_active) && $menu_active == $menu) {
								$class_def .= ' active';
							}
							$class_def = trim($class_def);
							if ($class_def) {
								$class_def = ' class="' . $class_def . '"';
							}
							echo "<li{$class_def}><a{$anchor_attrs}>{$item_name}</a>";

							if (isset($item['sub'])) {
								echo '<ul class="dropdown-menu">';
								foreach ($item['sub'] as $sub_menu => $sub_item) {
									echo '<li><a href="',
										base_url($sub_item['url']), '">',
										$sub_item['name'], '</a></li>';
								}
								echo '</ul>';
							}
							echo '</li>';
						}
						?>
						</ul>
						<div class="btn-group pull-right">
							<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user icon-white"></i>
								<?php echo $fullname ?>
								<i class="caret"></i>
							</button>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('admin/user'); ?>">Account</a></li>
								<li class="divider"></li>
								<li> <a href="<?php echo base_url('admin/logout'); ?>">Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid" style="padding-top:60px">
