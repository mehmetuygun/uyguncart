<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="addressModalLabel"><?php echo isset($address) ? 'Edit' : 'Add' ?> Address</h4>
		</div>
		<form class="form-horizontal" role="form" method="post" onsubmit="saveAddress(this); return false" action="<?php echo base_url('address/edit/' . $address_id) ?>">
			<div class="modal-body">
				<div class="container">
					<div class="form-group">
						<label for="address_name" class="col-lg-3 control-label">Address Name:</label>
						<div class="col-lg-9">
							<input type="text" id="address_name" name="address_name" class="form-control" value="<?php echo isset($address) ? $address['address_name'] : '' ?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-lg-3 control-label">Full Name:</label>
						<div class="col-lg-9">
							<input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo isset($address) ? $address['full_name'] : '' ?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="address1" class="col-lg-3 control-label">Address 1:</label>
						<div class="col-lg-9">
							<input type="text" id="address1" name="address1" class="form-control" value="<?php echo isset($address) ? $address['address1'] : '' ?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="address2" class="col-lg-3 control-label">Address 2:</label>
						<div class="col-lg-9">
							<input type="text" id="address2" name="address2" class="form-control" value="<?php echo isset($address) ? $address['address2'] : '' ?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="col-lg-3 control-label">City:</label>
						<div class="col-lg-9">
							<input type="text" id="city" name="city" class="form-control" value="<?php echo isset($address) ? $address['city'] : '' ?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="postcode" class="col-lg-3 control-label">Postcode:</label>
						<div class="col-lg-9">
							<input type="text" id="postcode" name="postcode" class="form-control" value="<?php echo isset($address) ? $address['postcode'] : '' ?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="country_id" class="col-lg-3 control-label">Country:</label>
						<div class="col-lg-9">
							<?php echo form_dropdown('country_id', $countries, isset($address) ? $address['country_id'] : 0, 'class="form-control" id="country_id"') ?>
							<span class="help-block"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary" id="modalSubmitButton">Save changes</button>
			</div>
		</form>
	</div>
</div>
