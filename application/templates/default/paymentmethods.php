<div class="panel panel-primary">
	<div class="panel-heading">
		Address Information / <b>Payment Methods</b> / Order Confirmation
	</div>
	<div class="panel-body">
		<h4>Select payment method you want to complete checkout with</h4>
		<br>
		<form>
			<div class="radio">
			  	<label>
			    	<input type="radio" name="paymentMethod" value="1" checked>
			    	<img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;">
			  	</label>
			</div>
			<br>
			<hr>
			<a href="<?php echo base_url('checkout/address'); ?>" class="btn btn-primary">Back</a>
			<button type="submit" class="btn btn-primary pull-right">Next</button>
		</form>
	</div>
</div>