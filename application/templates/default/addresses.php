<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<a href="<?php echo base_url('user/account')?>" class="list-group-item">Account</a>
			<a href="<?php echo base_url('address')?>" class="list-group-item active">Address</a>
			<a href="<?php echo base_url('user/password')?>" class="list-group-item">Password</a>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Address <small>Manage address information.</small></h3>
				<hr>
				<table class="table table-bordered" id="address_table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<a href="<?php echo base_url('address/edit/0') ?>" data-target="#addressModal" data-toggle="modal" class="btn btn-primary">Add New Address</a>
			</div>
		</div>
	</div>
</div>
<div id="addressModal" class="modal fade"></div>
