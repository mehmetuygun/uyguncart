<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="addressModalLabel">Modal title</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('address/edit/0') ?>">
				<div class="modal-body">
					<div class="container">
						<div class="form-group">
							<label for="inputName" class="col-lg-3 control-label">Address Name:</label>
							<div class="col-lg-9">
								<input type="text" id="inputName" name="addressName" class="form-control" value="">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-lg-3 control-label">Full Name:</label>
							<div class="col-lg-9">
								<input type="text" id="full_name" name="full_name" class="form-control" value="">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="country_id" class="col-lg-3 control-label">Country:</label>
							<div class="col-lg-9">
								<?php echo form_dropdown('country_id', $countries, set_value('country_id', 0), 'class="form-control" id="country_id"') ?>
								<span class="help-block"><?php echo form_error('country_id'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="city" class="col-lg-3 control-label">City:</label>
							<div class="col-lg-9">
								<input type="text" id="city" name="city" class="form-control" value="">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="address1" class="col-lg-3 control-label">Address 1:</label>
							<div class="col-lg-9">
								<input type="text" id="address1" name="address1" class="form-control" value="">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="address2" class="col-lg-3 control-label">Address 2:</label>
							<div class="col-lg-9">
								<input type="text" id="address2" name="address2" class="form-control" value="">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-lg-3 control-label">Postcode:</label>
							<div class="col-lg-9">
								<input type="text" id="postcode" name="postcode" class="form-control" value="">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="modalSubmitButton">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
