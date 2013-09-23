<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">Adresses</h3></div>
	<div class="panel-body">
	<?php 
	if($select == 'add') {
		?>

		<form class="form-horizontal" role="form" action="" method="POST">
		  	<div class="form-group">
		    	<label for="name" class="col-lg-2 control-label">Full Name:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="name" name="name" class="form-control" value="<?php set_value('name', '5') ?>">
		      		<span class="help-block"><?php echo form_error('name'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="country" class="col-lg-2 control-label">Country:</label>
		    	<div class="col-lg-10">
		      		<?php echo form_dropdown('country', $countries, set_value('country', '235'), 'class = "form-control" id="country"') ?>
		      		<span class="help-block"><?php echo form_error('country'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="city" class="col-lg-2 control-label">City:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="city" name="city" class="form-control" value="<?php set_value('city', '') ?>">
		      		<span class="help-block"><?php echo form_error('city'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="city" class="col-lg-2 control-label">Address 1:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="address1" name="address1" class="form-control" value="<?php set_value('address1', '') ?>">
		      		<span class="help-block"><?php echo form_error('address1'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="city" class="col-lg-2 control-label">Address 2:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="address2" name="address2" class="form-control" value="<?php set_value('address2', '') ?>">
		      		<span class="help-block"><?php echo form_error('address2'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="city" class="col-lg-2 control-label">Postcode:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="postcode" name="postcode" class="form-control" value="<?php set_value('postcode', '') ?>">
		      		<span class="help-block"><?php echo form_error('postcode'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<div class="col-lg-offset-2 col-lg-10">
		      		<button type="submit" class="btn btn-default">Add</button>
		    	</div>
		  	</div>
		</form>

		<?php
	} else if ($select == 'edit') {
		echo 'edit';
	} else {
	?>
		<table class="table table-bordered" id="address_table">
			<thead>
				<tr>
					<th></th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<a href="<?php echo base_url('user/addresses/create') ?>" class="btn btn-primary">Create New Address</a>
	<?php 
	}
	?>	
	</div>
</div>
