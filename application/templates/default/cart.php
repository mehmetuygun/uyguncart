<div class="panel panel-primary">
	<div class="panel-heading">Cart</div>
	<div class="panel-body">
		<?php
		if(isset($error)) {
			echo '<div class="alert alert-'.$error_type.'">';
			echo $error_message;
			echo '</div>';
		}
		if(!$items) {
			echo '<div class="alert alert-info">';
			echo 'Your shopping cart is empty.';
			echo '</div>';
			echo '<a href="'.base_url().'" class="btn btn-default">Back to Home Page</a>';
		} else {
			?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Action</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Sub Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$totalPrice = 0;
					foreach ($items as $item) {
						echo '<tr>';
						echo '<td>';
						echo '<form method="POST" action="">';
						echo '<input type="hidden" name="add_qty" value="1"/>';
						echo '<input type="hidden" name="rowid" value="'.$item['rowid'].'"/>';
						echo '<input type="hidden" name="qty" value="0"/>';
						echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span></button>';
						echo '</form>';
						echo '</td>';
						echo '<td>';
						echo $item['name'];
						echo '</td>';
						echo '<td>';
						echo '<form method="POST" action="">';
						echo '<input type="hidden" name="add_qty" value="1"/>';
						echo '<input type="hidden" name="productID" value="'.$item['id'].'"/>';
						echo '<input type="hidden" name="rowid" value="'.$item['rowid'].'"/>';
						echo '<input type="text" name="qty" value="'.$item['qty'].'" class="form-control input-sm" style="width:40px;display:inline"> ';
						echo '<button type="submit" class="btn btn-default btn-sm">Update</button>';
						echo '</form>';
						echo '</td>';
						echo '<td>';
						echo '$' . number_format($item['price'], 2);
						echo '</td>';
						echo '<td>';
						echo '$' . number_format($item['subtotal'], 2);
						echo '</td>';
						echo '</tr>';
						$totalPrice += $item['subtotal'];
					}
					echo '<tr>';
					echo '<td colspan="4" align="right">Total</td>';
					echo '<td>$'. number_format($totalPrice, 2).'</td>';
					echo '</tr>';
					?>
				</tbody>
			</table>
			<a class="btn btn-primary pull-left" href="<?php echo base_url() ?>">Continue Shoopping</a>
			<a class="btn btn-warning pull-right" href="<?php echo base_url('checkout') ?>">Checkout</a>
			<div class="clearfix"></div>
			<?php
			}
		?>
	</div>
</div>
