<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">Adresses</h3></div>
	<div class="panel-body">
	<?php 
	if($select == 'create') {
		echo 'create';
	} else if ($select == 'edit') {
		echo 'edit';
	} else {
	?>
		<table class="table table-bordered" id="address_table">
			<thead>
				<tr>
					<th></th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<a data-toggle="modal" href="#create_address" class="btn btn-primary">Create New Address</a>
	<?php 
	}
	?>	
	</div>
</div>

<div class="modal fade" id="create_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        	<h4 class="modal-title">Create New Address</h4>
	      	</div>
	      	<div class="modal-body">
		        <form class="form-horizontal" role="form" method="POST" action="">
					<div class="form-group <?php if(form_error('email')) echo "has-error"; ?>">
						<label for="inputEmail1" class="col-lg-2 control-label">Email</label>
						<div class="col-lg-10 error">
							<input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email" value="<?php echo set_value('email', $userEmail); ?>">
							<span class="help-block"><?php echo form_error('email'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if(form_error('firstname')) echo "has-error"; ?>">
						<label for="inputfirstname" class="col-lg-2 control-label">First Name</label>
						<div class="col-lg-10">
							<input type="text" name="firstname" class="form-control" id="inputfirstname" placeholder="First Name" value="<?php echo set_value('firstname', $userFirstName); ?>">
							<span class="help-block"><?php echo form_error('firstname'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if(form_error('lastname')) echo "has-error"; ?>">
						<label for="inputlastname" class="col-lg-2 control-label">Last Name</label>
						<div class="col-lg-10">
							<input type="text" name="lastname" class="form-control" id="inputlastname" placeholder="Last Name" value="<?php echo set_value('lastname', $userLastName); ?>">
							<span class="help-block"><?php echo form_error('lastname'); ?></span>
						</div>
					</div>
				</form>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	<button type="button" class="btn btn-primary">Create</button>
	      	</div>
	    </div>
  	</div>
</div>