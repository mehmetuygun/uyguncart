<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-4">
				<div class="img-main-frame">
					<?php echo '<img class="media-object" width="300" height="169" src="http://localhost/uyguncart/public/images/x/p1152136f514a94e.jpg"/>'; ?>
				</div>
			</div>
			<div class="col-sm-6">
				<h3 class="media-heading">
					<?php 
						// echo $row->productName; 
					echo $row->productName;
					?>
				</h3>
				<table class="table">
					<tbody>
						<tr>
							<td>Rating</td>
							<td></td>
						</tr>
						<tr>
							<td>Price:</td>
							<td><span class="price"><?php echo $row->productPrice; ?>$</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-primary pull-right">Add to Cart</button>
			</div>
		</div>
	</div>
</div>
	<div class="tabbable" style="margin-bottom: 18px;">
	 	<ul class="nav nav-pills nav-justified tab-style">
		    <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
		    <li class=""><a href="#tab2" data-toggle="tab">Comment</a></li>
	 	</ul>
      	<div class="tab-content tab-content-style" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
	        <div class="tab-pane" id="tab1">
	          	<?php echo $row->productDescription; ?>
	        </div>
	        <div class="tab-pane active" id="tab2">
	          	<p>Howdy, I'm in Section 2.</p>
	        </div>
      	</div>
    </div>