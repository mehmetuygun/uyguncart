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
	  			  			<div class="form-group">
				  				<select class="form-control input-xs col-xs-3" name="orderby">
				  					<option value="name">Name</option>
				  					<option value="price">Price</option>
				  				</select>
			  				</div>
				  				<input name="page" type="hidden" value="<?php if(isset($_GET['p'])) echo $_GET['p']; else echo 1; ?>">
		  			  			<button type="submit" class="btn btn-default">Sort</button>
	  			  		</form>

		  			</div>
	  				<ul class="pagination pull-right">
				        <li class="disabled"><a href="#">«</a></li>
				        <li class="active"><a href="#">1</a></li>
				        <li><a href="#">2</a></li>
				        <li><a href="#">3</a></li>
				        <li><a href="#">4</a></li>
				        <li><a href="#">5</a></li>
				        <li><a href="#">»</a></li>
	     			</ul>
	     			<div class="clearfix"></div>
	     			<div class="result-body">
					 	
					 	<?php
					 	foreach ($products as $row) {
					 	echo '
					 	<div class="media">
			        		<a class="pull-left" href="#">
			          			<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACDUlEQVR4Xu2Yz6/BQBDHpxoEcfTjVBVx4yjEv+/EQdwa14pTE04OBO+92WSavqoXOuFp+u1JY3d29rvfmQ9r7Xa7L8rxY0EAOAAlgB6Q4x5IaIKgACgACoACoECOFQAGgUFgEBgEBnMMAfwZAgaBQWAQGAQGgcEcK6DG4Pl8ptlsRpfLxcjYarVoOBz+knSz2dB6vU78Lkn7V8S8d8YqAa7XK83ncyoUCjQej2m5XNIPVmkwGFC73TZrypjD4fCQAK+I+ZfBVQLwZlerFXU6Her1eonreJ5HQRAQn2qj0TDukHm1Ws0Ix2O2260RrlQqpYqZtopVAoi1y+UyHY9Hk0O32w3FkI06jkO+74cC8Dh2y36/p8lkQovFgqrVqhFDEzONCCoB5OSk7qMl0Gw2w/Lo9/vmVMUBnGi0zi3Loul0SpVKJXRDmphvF0BOS049+n46nW5sHRVAXMAuiTZObcxnRVA5IN4DJHnXdU3dc+OLP/V63Vhd5haLRVM+0jg1MZ/dPI9XCZDUsbmuxc6SkGxKHCDzGJ2j0cj0A/7Mwti2fUOWR2Km2bxagHgt83sUgfcEkN4RLx0phfjvgEdi/psAaRf+lHmqEviUTWjygAC4EcKNEG6EcCOk6aJZnwsKgAKgACgACmS9k2vyBwVAAVAAFAAFNF0063NBAVAAFAAFQIGsd3JN/qBA3inwDTUHcp+19ttaAAAAAElFTkSuQmCC" style="width: 64px; height: 64px;">
			        		</a>
			        		<div class="media-body">
			          		<h4 class="media-heading"><a href="#">'.$row['productName'].'</a></h4>
			          		<span class="price">'.$row['productPrice'].'$</span>
			        		</div>
		      			</div>';
		      			}
		      			?>
	     			</div>
	  			  	<div class="pull-left pagination">
	  			  		<form method="GET" action="" class="form-inline" role="form">
	  			  			<div class="form-group">
				  				<select class="form-control input-xs col-xs-3" name="orderby">
				  					<option value="name">Name</option>
				  					<option value="price">Price</option>
				  				</select>
			  				</div>
				  				<input name="page" type="hidden" value="<?php if(isset($_GET['p'])) echo $_GET['p']; else echo 1; ?>">
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