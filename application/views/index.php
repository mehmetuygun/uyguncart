<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap3/css/bootstrap.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap3/css/bootstrap-glyphicons.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/default/css/style.css');?>">
	</head>
	<body>
		<div id="wrap">
			<div class="navbar navbar-fixed-top">
				<div class="container">
					<div class="row">
  						<div class="col-lg-3">
  							<a class="navbar-brand" href="#">UygunCart</a>
  						</div>
  						<div class="col-lg-9">
							<form class="navbar-form pull-left" action="">
		              			<input type="text" class="form-control" id="search" placeholder="Search">
		              			<button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
		            		</form>
		            		<span class="navbar-form pull-right">
		            			<a href="#" class="btn btn-success">Login</a>
		            			<a href="#" class="btn btn-default">Register</a>
		            		</span>
  						</div>
  					</div>
				</div>
			</div>
			<div class="container" style="width:960px">
				<div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Panel title</h3>
        </div>
        Panel content
      </div>
			</div>
			<div id="push"></div>
	    	<!-- End of wrap -->
		</div>
		<div id="footer">
	      	<div class="container">
	        	<p class="muted credit">UygunCart</p>
	      	</div>
	      	<!-- end of footer -->
	    </div>
		<script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.10.2.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('public/bootstrap3/js/bootstrap.min.js');?>"></script>
		<?php
		if(isset($js)){
			foreach ($js as $value) {
				echo '<script type="text/javascript" src="'.base_url($value).'"></script>';
			}
		}
		?>
	</body>
</html>