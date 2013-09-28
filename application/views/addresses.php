<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">Adresses</h3></div>
	<div class="panel-body">
	<?php
	if(isset($_GET['alert']) && $_GET['alert'] == 'success-add') {
	    echo '<div class="alert alert-success">';
	   	echo 'The address is added succesfuly.';
	    echo '</div>';
	} else if(isset($_GET['alert']) && $_GET['alert'] == 'success-edit') {
		echo '<div class="alert alert-success">';
	   	echo 'The address is updated succesfuly.';
	    echo '</div>';
	} else if(isset($_GET['alert']) && $_GET['alert'] == 'success-delete') {
		echo '<div class="alert alert-success">';
	   	echo 'The address is deleted succesfuly.';
	    echo '</div>';
	}

	if($select == 'add') {
		?>

		<form class="form-horizontal" role="form" action="" method="POST">
		  	<div class="form-group <?php if(form_error('name')) echo "has-error"; ?>">
		    	<label for="name" class="col-lg-2 control-label">Full Name:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="name" name="name" class="form-control" value="<?php echo set_value('name', $fullname); ?>">
		      		<span class="help-block"><?php echo form_error('name'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('country_id')) echo "has-error"; ?>">
		    	<label for="country_id" class="col-lg-2 control-label">Country:</label>
		    	<div class="col-lg-10">
		      		<?php echo form_dropdown('country_id', $countries, set_value('country_id', ''), 'class = "form-control" id="country_id"') ?>
		      		<span class="help-block"><?php echo form_error('country_id'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('city')) echo "has-error"; ?>">
		    	<label for="city" class="col-lg-2 control-label">City:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="city" name="city" class="form-control" value="<?php echo set_value('city', '') ?>">
		      		<span class="help-block"><?php echo form_error('city'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('address1')) echo "has-error"; ?>">
		    	<label for="address1" class="col-lg-2 control-label">Address 1:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="address1" name="address1" class="form-control" valhue="<?php echo set_value('address1', '') ?>">
		      		<span class="help-block"><?php echo form_error('address1'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('address2')) echo "has-error"; ?>">
		    	<label for="address2" class="col-lg-2 control-label">Address 2:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="address2" name="address2" class="form-control" value="<?php echo set_value('address2', '') ?>">
		      		<span class="help-block"><?php echo form_error('address2'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('postcode')) echo "has-error"; ?>">
		    	<label for="postcode" class="col-lg-2 control-label">Postcode:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="postcode" name="postcode" class="form-control" value="<?php echo set_value('postcode', '') ?>">
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
		if(empty($addresses)) {
			echo '<div class="alert alert-warning">';
	   		echo 'The address you are looking for is not found';
	    	echo '</div>';
	    	echo '<a href="'.base_url('user/addresses').'" class="btn btn-primary">Go Back</a>';
		} else {
			?>
		<form class="form-horizontal" role="form" action="" method="POST">
		  	<div class="form-group <?php if(form_error('name')) echo "has-error"; ?>">
		    	<label for="name" class="col-lg-2 control-label">Full Name:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="name" name="name" class="form-control" value="<?php echo set_value('name', $addresses[0]['full_name']); ?>">
		      		<span class="help-block"><?php echo form_error('name'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('country_id')) echo "has-error"; ?>">
		    	<label for="country_id" class="col-lg-2 control-label">Country:</label>
		    	<div class="col-lg-10">
		      		<?php echo form_dropdown('country_id', $countries, set_value('country_id', $addresses[0]['country_id']), 'class = "form-control" id="country_id"') ?>
		      		<span class="help-block"><?php echo form_error('country_id'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('city')) echo "has-error"; ?>">
		    	<label for="city" class="col-lg-2 control-label">City:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="city" name="city" class="form-control" value="<?php echo set_value('city', $addresses[0]['city']) ?>">
		      		<span class="help-block"><?php echo form_error('city'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('address1')) echo "has-error"; ?>">
		    	<label for="address1" class="col-lg-2 control-label">Address 1:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="address1" name="address1" class="form-control" value="<?php echo set_value('address1', $addresses[0]['address1']) ?>">
		      		<span class="help-block"><?php echo form_error('address1'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('address2')) echo "has-error"; ?>">
		    	<label for="address2" class="col-lg-2 control-label">Address 2:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="address2" name="address2" class="form-control" value="<?php echo set_value('address2', $addresses[0]['address2']) ?>">
		      		<span class="help-block"><?php echo form_error('address2'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group <?php if(form_error('postcode')) echo "has-error"; ?>">
		    	<label for="postcode" class="col-lg-2 control-label">Postcode:</label>
		    	<div class="col-lg-10">
		      		<input type="text" id="postcode" name="postcode" class="form-control" value="<?php echo set_value('postcode', $addresses[0]['postcode']) ?>">
		      		<span class="help-block"><?php echo form_error('postcode'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<div class="col-lg-offset-2 col-lg-10">
		      		<button type="submit" class="btn btn-default">Save Changes</button>
		    	</div>
		  	</div>
		</form>
			<?php
		}
	} else if($select == 'delete') {

		if(empty($addresses)) {
			echo '<div class="alert alert-warning">';
	   		echo 'You do not have permission to delete this address';
	    	echo '</div>';
	    	echo '<a href="'.base_url('user/addresses').'" class="btn btn-primary">Go Back</a>';
		} else {

			?>
			<form method="POST" action="">
				<div class="alert alert-warning">
					<p>Are you sure to delete this address. </p>
					<p><?php echo $addresses[0]['full_name'].' '.$addresses[0]['name'].' '.$addresses[0]['city'].' '.$addresses[0]['address1'].' '.$addresses[0]['address2'].' '.$addresses[0]['postcode'];?></p>
					<p>
						<button type="submit" class="btn btn-primary">Yes</button>
						<a href="<?php echo base_url('user/addresses') ?>">Cancel</a>
					</p>
				</div>
			</form>
			<?php

		}

	} else {
	?>
		<table class="table table-bordered" id="address_table">
			<thead>
				<tr>
					<th>#</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$count = 1;
			foreach ($addresses as $row) {
				echo '<tr><td>'.$count.'</td>';
				echo '<td>'.$row['full_name'].' '.$row['name'].' '.$row['city'].' '.$row['address1'].' '.$row['address2'].' '.$row['postcode'].'</td>';
				echo '<td><a href="'.base_url('user/addresses/edit/'.$row['address_id']).'">Edit</a>
				<a href="'.base_url('user/addresses/delete/'.$row['address_id']).'">Delete</a></td></tr>';
				$count++;
			}
			?>
			</tbody>
		</table>
		<a href="<?php echo base_url('user/addresses/add') ?>" class="btn btn-primary">Add New Address</a>
	<?php 
	}
	?>	
	</div>
</div>
