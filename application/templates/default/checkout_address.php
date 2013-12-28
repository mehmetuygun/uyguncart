<div class="panel panel-primary">
	<div class="panel-heading"><b>Address Information</b> / Payment Methods / Order Confirmation</div>
	<div class="panel-body">
		<div class="form-group">
			<a href="<?php echo base_url('address/edit/0') ?>" class="btn btn-default"
				data-target="#addressModal" data-toggle="modal">Add New Address</a>
		</div>
		<form method="POST" action="">
			<div class="row">
				<div class="col-md-6">
					<h4>Shipping Address</h4>
					<div class="form-group <?php if(form_error('saddress')) echo 'has-error'; ?>">
						<select id="saddress" name="saddress" class="form-control"></select>
						<span class="help-block"><?php echo form_error('saddress'); ?></span>
					</div>
				</div>
				<div class="col-md-6">
					<h4>Billing Address</h4>
					<div class="form-group <?php if(form_error('baddress')) echo 'has-error'; ?>">
						<select id="baddress" name="baddress" class="form-control"></select>
						<span class="help-block"><?php echo form_error('baddress') ?></span>
					</div>
				</div>
			</div>
			<hr>
			<a href="<?php echo base_url('cart'); ?>" class="btn btn-primary pull-left">Back</a>
			<button type="submit" class="btn btn-primary pull-right">Next</button>
		</form>
	</div>
</div>
<div id="addressModal" class="modal fade"></div>
