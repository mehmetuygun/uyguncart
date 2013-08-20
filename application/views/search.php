<ul class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Home</a><span class="divider"></span></li>
	<li class="active">Search</li>
</ul>
<?php 
if(empty($products)) {
?>
<div class="panel">
  	<div class="panel-heading">
    	<h3 class="panel-title">Search</h3>
  	</div>
  	<div class="alert">
        <!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
        No result found related with <strong>q</strong> 
     </div>
    Suggestion
    <ul>
    	<li>Make sure the word is correct.</li>
    	<li>Try to search with similar word.</li>
    </ul>
</div>
<?php
} else {
	?>
	<div class="row">
  		<div class="col-lg-3">
  			<div class="panel">
  				Category
  			</div>
  		</div>
  		<div class="col-lg-9">
  			<div class="panel">
  				<div class="panel-body">
  					
	  			  	<div class="pull-left pagination">
	  			  		<form method="GET" action="" class="form-inline" role="form">
	  			  			<input name="q" type="hidden" value="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>">
	  			  			<div class="form-group">
				  				<select class="form-control input-xs col-xs-3" name="orderby">
				  					<option value="name">Name</option>
				  					<option value="price">Price</option>
				  				</select>
			  				</div>
				  				<input name="per_page" type="hidden" value="<?php if(isset($_GET['per_page'])) echo $_GET['per_page']; else echo '1'; ?>">
		  			  			<button type="submit" class="btn btn-default">Sort</button>
	  			  		</form>

		  			</div>
		  			<?php echo $pagination; ?>
	     			<div class="clearfix"></div>
	     			<div class="result-body">
					 	
					 	<?php
					 	// var_dump($products);
					 	foreach ($products as $row) {
					 	echo '<div class="media">';
			        	echo '<a class="pull-left" href="#">';
			          	echo '<div class="img-frame x135"><img class="media-object" src="'.base_url('public/images/sm').'/'.$row['imageFullName'].'"/></div>';
			        	echo '</a>';
			        	echo '<div class="media-body">';
			          	echo '<h4 class="media-heading"><a href="#">'.$row['productName'].'</a></h4>';
			          	echo '<span class="price">'.$row['productPrice'].'$</span>';
			        	echo '</div></div>';
		      			}
		      			?>
	     			</div>
	  			  	<div class="pull-left pagination">
	  			  		<form method="GET" action="" class="form-inline" role="form">
	  			  			<input name="q" type="hidden" value="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>">
	  			  			<div class="form-group">
				  				<select class="form-control input-xs col-xs-3" name="orderby">
				  					<option value="name">Name</option>
				  					<option value="price">Price</option>
				  				</select>
			  				</div>
				  				<input name="per_page" type="hidden" value="<?php if(isset($_GET['per_page'])) echo $_GET['per_page']; else echo '1'; ?>">
		  			  			<button type="submit" class="btn btn-default">Sort</button>
	  			  		</form>
		  			</div>
	  				<?php echo $pagination; ?>
	     			<div class="clearfix"></div>
  				</div>
			</div>
  		</div>
	</div>
	<?php
}
?>