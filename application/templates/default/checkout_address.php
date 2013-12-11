<div class="panel panel-primary">
	<div class="panel-heading"><b>Address Information</b> / Payment Methods / Order Confirmation</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<h4>Shipping Address</h4>
				<form role="form">
				  	<div class="form-group">
				    	<select type="ShippingAddress" class="form-control">
				  			<option>Select your shipping address</option>
				      		<?php  
				      		foreach ($addresses as $row) {
				      			echo '<option value="'.$row['address_id'].'">';
				      			echo $row['full_name'].', ';
				      			echo $row['name'].', ';
				      			echo $row['city'].', ';
				      			echo $row['address1'].', ';
				      			echo $row['address2'];
				      			echo '</option>';
				      		}
				      		?>
				  		</select>
				  	</div>
				  	<div class="form-group">
				  		<a href="#" class="btn btn-default">Add New Shipping Address</a>
				  	</div>
			</div>
			<div class="col-md-6">
				<h4>Billing Address</h4>
				<div class="form-group">
			    	<select name="BillingAddress" class="form-control">
			  			<option>Select your billing address</option>
			 			<?php  
			      		foreach ($addresses as $row) {
			      			echo '<option value="'.$row['address_id'].'">';
			      			echo $row['full_name'].', ';
			      			echo $row['name'].', ';
			      			echo $row['city'].', ';
			      			echo $row['address1'].', ';
			      			echo $row['address2'];
			      			echo '</option>';
			      		}
			      		?>
			  		</select>
			  	</div>
			  	<div class="form-group">
			  		<a href="#" class="btn btn-default">Add New Billing Address</a>
			  	</div>
			</div>
		</div>
		<hr>
		<a href="<?php echo base_url('cart'); ?>" class="btn btn-primary">Back</a>
		<button type="submit" class="btn btn-primary pull-right">Next</button>
		<form>
	</div>
</div>