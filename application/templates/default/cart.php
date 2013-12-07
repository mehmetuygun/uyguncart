<div class="panel panel-primary">
	<?php $step2 = $this->input->post('step2'); ?>
	<div class="panel-heading"><?php if(isset($step2) && empty($step2)) echo '<b>Set Cart - Step1</b>'; else echo 'Set Cart - Step1'; ?> | <?php if(isset($step2) && !empty($step2)) echo '<b>Address - Step2</b>'; else echo 'Address - Step2'; ?> | Complete Payment - Step3</div>
	<div class="panel-body">
		<?php
		if(!empty($step2)) {
			?>
			<form method="POST" action="" class="form-horizontal" role="form">
				<div class="form-group">
				    <label for="inputBilling" class="col-sm-2 control-label">Billing Address</label>
				    <div class="col-sm-10">
				      	<select class="form-control" id="inputBilling" name="billingAddress">
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
				    </div>
  				</div>
				<div class="form-group">
				    <label for="inputShipping" class="col-sm-2 control-label">Shipping Address</label>
				    <div class="col-sm-10">
				    	<select class="form-control" id="inputShipping" name="shippingAddress">
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
				    </div>
  				</div>
  				<a href="<?php echo base_url('cart'); ?>" class="btn btn-primary pull-left">Back</a>
  				<button type="submit" class="btn btn-warning pull-right">Complete</button>
			</form>
			<?php
		} else {
		if(isset($error)) {
			echo '<div class="alert alert-'.$error_type.'">';
			echo $error_message;
			echo '</div>';
		}
		if(!$items) {
			echo '<div class="alert alert-warning">';
			echo 'Your shopping cart is empty.';
			echo '</div>';
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
						echo '$' . $item['price'];
						echo '</td>';
						echo '<td>';
						echo '$' . $item['subtotal'];
						echo '</td>';
						echo '</tr>';
						$totalPrice += $item['subtotal'];
					}
					echo '<tr>';
					echo '<td colspan="4">Total</td>';
					echo '<td>$'.$totalPrice.'</td>';
					echo '</tr>';
					?>
				</tbody>
			</table>
			<a class="btn btn-primary pull-left" href="<?php echo base_url() ?>">Continue Shoopping</a>
			<a class="btn btn-warning pull-right" href="<?php echo base_url('checkout/address') ?>">Continue to buy</a>
			<div class="clearfix"></div>
			<?php
			}
		} // end of else
		?>
	</div>
</div>
