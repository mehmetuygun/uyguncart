<div class="panel">
	<div class="panel-heading">Cart</div>
	<div class="panel-body">
		<?php
		if(!$items) {
			echo '<div class="alert alert-warning">';
			echo 'Your shopping cart is empty.';
			echo '</div>';
		} else {
			?>
			<table class="table table-bordered">
				<thead>
					<th>Action</th>
					<th>Product</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Sub Total</th>
				</thead>
				<tbody>
					<?php
					$totalPrice = 0;
					foreach ($items as $item) {
						echo '<tr>';
						echo '<td>';
						echo 'remove';
						echo '</td>';
						echo '<td>';
						echo $item['name'];
						echo '</td>';
						echo '<td>';
						echo '<form method="POST" action="">';
						echo '<input type="hidden" name="add_qty" value="1"/>';
						echo '<input type="text" name="qty" value="'.$item['qty'].'" class="col-lg-2">';
						echo '<button type="submit" class="btn btn-default btn-xs">Update</button>';
						echo '</form>';
						echo '</td>';
						echo '<td>';
						echo $item['price'].'$';
						echo '</td>';
						echo '<td>';
						echo $item['subtotal'].'$';
						echo '</td>';
						echo '</tr>';
						$totalPrice += $item['subtotal'];
					}
					echo '<tr>';
					echo '<td colspan="4">Total</td>';
					echo '<td>'.$totalPrice.'$</td>';
					echo '</tr>';
					?>
				</tbody>
			</table>
			<?php 
		} // end of else 
		?>
	</div>
</div>