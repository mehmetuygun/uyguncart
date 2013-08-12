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
            <div id="header">
                <div class="container header-up">
                    <span class="pull-right">
                        <a href="#">Register</a>
                        <a href="#">Login</a>
                    </span>
                </div>
    			<div class="container">
    				<div class="row">
    						<div class="col-lg-3">
    							<a class="navbar-brand" href="#">UygunCart</a>
    						</div>
    						<div class="col-lg-9">
    						<form class="navbar-form pull-left" action="<?php echo base_url('search') ?>" method="get">
    	              			<input type="text" name="q" class="form-control" id="search" placeholder="Search">
    	              			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
    	            		</form>
                            <span class="navbar-form pull-right">
                                <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Empty</a>
                            </span>
    						</div>
    					</div>
    			</div>
            </div>
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
                    category here
					</div>
                    <div class="col-lg-9">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Recenlty Added</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content with-frame">
                            <div class="tab-pane fade active in" id="home">
                            <?php
                            $i=0;
                            while ($i<9) {
                                if($i%3 == 0)
                                    echo '</div>';

                                if($i == 0 or $i%3 == 0 and $i!=9)
                                    echo '<div class="row f-space">';

                                echo '<div class="col-lg-4">
                                        <div class="thumbnail">
                                            <img  alt="200x150"/>
                                            <div class="caption">
                                                <h4><a href="#">Maclaren Rocker Black Champaigne</h4>
                                                <h4><span class="price">500 $</span></h4>
                                                <p><a href="#" class="btn btn-danger" style="width:100%">Add To Cart</a></p>
                                            </div>
                                        </div>
                                    </div>';

                                // echo '<div class="col-lg-4">
                                //         <div class="thumbnail">
                                //             <img  alt="200x150" src="'.$recenltyAdded[$i]["imgSrc"].'"/>
                                //             <div class="caption">
                                //                 <h4><a href="'.base_url('product/id/'.$recenltyAdded[$i]["productId"]).'">'.$recenltyAdded[$i]["productName"].'</h4>
                                //                 <h4><span class="price">'.$recenltyAdded[$i]["productPrice"].'</span></h4>
                                //                 <p><a href="#" class="btn btn-danger .f-add-to-cart ">Add To Cart</a></p>
                                //             </div>
                                //         </div>
                                //     </div>';

                                $i++;
                            } // end while
                            ?>
                            </div>
        				</div>
                    </div>
			    </div>
                <div class="f-footer-space"></div>
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