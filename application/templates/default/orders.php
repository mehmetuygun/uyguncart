<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<a href="<?php echo base_url('user/account')?>" class="list-group-item">Account</a>
			<a href="<?php echo base_url('address')?>" class="list-group-item">Address</a>
			<a href="<?php echo base_url('user/password')?>" class="list-group-item">Password</a>
			<a href="<?php echo base_url('orders')?>" class="list-group-item active">Orders</a>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Orders <small>See your order history.</small></h3>
				<hr>
				<table class="table table-bordered" id="address_table">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($orders as $order) {
						echo '<tr><td>', $order['order_id'], '</td><td>',
							$order['added_date'] , '</td><td>',
							number_format($order['total_price'], 2),
							'</td></tr>';
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
