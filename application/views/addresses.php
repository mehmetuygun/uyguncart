<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">Adresses</h3></div>
	<div class="panel-body">
	<?php 
	if($select == 'create') {
		echo 'create';
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
		<a data-toggle="modal" href="<?php echo base_url('user/addresses/create') ?>" class="btn btn-primary">Create New Address</a>
	<?php 
	}
	?>	
	</div>
</div>
