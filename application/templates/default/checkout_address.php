<div class="panel panel-primary">
	<div class="panel-heading"><b>Address Information</b> / Payment Methods / Order Confirmation</div>
	<div class="panel-body">
		<form method="POST" action="">
		<div class="row">
			<div class="col-md-6">
				<h4>Shipping Address</h4>
			  	<div class="form-group <?php if(form_error('saddress')) echo 'has-error'; ?>">
			    	<select name="saddress" class="form-control">
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
			  		<span class="help-block"><?php echo form_error('saddress'); ?></span>
			  	</div>
			  	<div class="form-group">
			  		<a href="#" class="btn btn-default">Add New Shipping Address</a>
			  	</div>
			</div>
			<div class="col-md-6">
				<h4>Billing Address</h4>
				<div class="form-group <?php if(form_error('baddress')) echo 'has-error'; ?>">
			    	<select name="baddress" class="form-control">
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
			  		<span class="help-block"><?php echo form_error('baddress') ?></span>
			  	</div>
			  	<div class="form-group">
			  		<a href="#" class="btn btn-default">Add New Billing Address</a>
			  	</div>
			</div>
		</div>
		<hr>
		<a href="<?php echo base_url('cart'); ?>" class="btn btn-primary">Back</a>
		<button type="submit" class="btn btn-primary pull-right">Next</button>
		</form>
	</div>
</div>