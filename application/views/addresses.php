<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">Adresses</h3></div>
	<div class="panel-body">
	<?php 
	if($select == 'create') {
		?>

		<form class="form-horizontal" role="form">
		  	<div class="form-group">
		    	<label for="inputAddress1" class="col-lg-2 control-label">Address</label>
		    	<div class="col-lg-10">
		      		<?php echo form_dropdown('country_id', $countries, set_value('country_id', $country_id)) ?>
		      		<span class="help-block"><?php echo form_error('country_id'); ?></span>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<div class="col-lg-offset-2 col-lg-10">
		      		<button type="submit" class="btn btn-default">Create</button>
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
