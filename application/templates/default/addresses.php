<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<a href="<?php echo base_url('user/account')?>" class="list-group-item">Account</a>
			<a href="#" class="list-group-item active">Address</a>
			<a href="<?php echo base_url('user/password')?>" class="list-group-item">Password</a>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Address <small>Manage address information.</small></h3>
				<hr>
				<?php
				$alert = isset($_GET['alert']) ? $_GET['alert'] : '';
				switch ($alert) {
					case 'success-add':
						$msg = 'The address has been successfully added.';
						break;
					case 'success-edit':
						$msg = 'The address has been successfully updated.';
						break;
					case 'success-delete':
						$msg = 'The address has been successfully deleted.';
						break;
				}

				if (isset($msg)) {
					echo '<div class="alert alert-success">', $msg, '</div>';
				}

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
						echo '<td>'.$row['full_name'].' '.$row['address1'].' '.$row['address2'].' '.$row['city'].' '.$row['postcode'].' '.$row['name'].'</td>';
						echo '<td><a href="'.base_url('address/edit/'.$row['address_id']).'" data-target="#addressModal" data-toggle="modal">Edit</a>
						<a href="'.base_url('user/addresses/delete/'.$row['address_id']).'">Delete</a></td></tr>';
						$count++;
					}
					?>
					</tbody>
				</table>
				<a href="<?php echo base_url('address/edit/0') ?>" data-target="#addressModal" data-toggle="modal" class="btn btn-primary">Add New Address</a>
			</div>
		</div>
	</div>
</div>
<div id="addressModal" class="modal fade"></div>
