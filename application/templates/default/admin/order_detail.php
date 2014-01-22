<div class="tabbable"> <!-- Only required for left/right tabs -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#order" data-toggle="tab">Order</a></li>
		<li><a href="#shipping" data-toggle="tab">Shipping</a></li>
		<li><a href="#billing" data-toggle="tab">Billing</a></li>
		<li><a href="#items" data-toggle="tab">Items</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="order">
			<dl class="dl-horizontal">
				<dt>Order ID:</dt>
				<dd class="order_id"><?php echo $order[0]['order_id'];?></dd>
				<dt>Payment Method:</dt>
				<dd class="payment_method">Paypal</dd>
				<dt>Customer:</dt>
				<dd class="customer"><?php echo $order[0]['first_name'].' '.$order[0]['last_name']; ?></dd>
				<dt>Email:</dt>
				<dd class="email"><?php echo $order[0]['email']; ?></dd>
				<dt>Total Price:</dt>
				<dd class="total_price">$<?php echo $order[0]['total_price']; ?></dd>
				<dt>Date Added:</dt>
				<dd class="date_added"><?php echo $order[0]['added_date']; ?></dd>
			</dl>
		</div>
		<div class="tab-pane" id="shipping">
			<dl class="dl-horizontal">
				<dt>Customer:</dt>
				<dd class="shipping_customer"><?php echo $order[0]['first_name'].' '.$order[0]['last_name']; ?></dd>
				<dt>Client Name:</dt>
				<dd class="shipping_customer"><?php echo $shipping[0]['full_name']; ?></dd>
				<dt>Country:</dt>
				<dd class="shipping_country"><?php echo $shipping[0]['name']; ?></dd>
				<dt>City:</dt>
				<dd class="shipping_city"><?php echo $shipping[0]['city']; ?></dd>
				<dt>Shipping Address:</dt>
				<dd class="shipping_address"><?php echo $shipping[0]['address1'] ?></dd>
				<dd class="shipping_address"><?php echo $shipping[0]['address2'] ?></dd>
				<dd class="shipping_address"><?php echo $shipping[0]['postcode'] ?></dd>
			</dl>
		</div>			    	
		<div class="tab-pane" id="billing">
			<dl class="dl-horizontal">
				<dt>Customer:</dt>
				<dd class="billing_customer"><?php echo $order[0]['first_name'].' '.$order[0]['last_name']; ?></dd>
				<dt>Client Name:</dt>
				<dd class="billing_customer"><?php echo $billing[0]['full_name']; ?></dd>
				<dt>Country:</dt>
				<dd class="billing_country"><?php echo $billing[0]['name']; ?></dd>
				<dt>City:</dt>
				<dd class="billing_city"><?php echo $billing[0]['city']; ?></dd>
				<dt>Billing Address:</dt>
				<dd class="billing_address"><?php echo $billing[0]['address1'] ?></dd>
				<dd class="billing_address"><?php echo $billing[0]['address2'] ?></dd>
				<dd class="billing_address"><?php echo $billing[0]['postcode'] ?></dd>
			</dl>
		</div>		    	
		<div class="tab-pane" id="items">
			<table class="table table-bordered" id="items_table">
				<thead>
					<tr>
						<th>Product</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Sub Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$total = 0;
					foreach ($items as $item) {
						$total += $item['quantity']*$item['unit_price'];
						echo '<tr>';
						echo '<td>'.$item['name'].'</td>';
						echo '<td>'.$item['quantity'].'</td>';
						echo '<td>$'.number_format($item['unit_price'], 2).'</td>';
						echo '<td>$'.number_format(($item['quantity']*$item['unit_price']), 2).'</td>';
						echo '</tr>';	 	
					}
					echo '<tr><td colspan="3">Total Price:</td><td>$'.number_format($total, 2).'</td></tr>';
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
