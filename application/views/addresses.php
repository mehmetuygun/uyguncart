<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">Adresses</h3></div>
	<div class="panel-body">
		<?php 
		if(isset($select)) {
			echo 'post';
		} else {
		?>
		<h4>Primary Address <small>This is your contact address. Keep it up to date.</small></h4>
		<p>Test, 123123 sokak</p><button class="btn btn-sm">Create</button>
		<hr>
		<h4>Shipping Address <small>This address is your items where to go. Make sure it is accurate.</small></h4>
		<p>Test, 123123 sokak</p><button class="btn btn-sm">Create</button>
		<?php 
		} // end of if
		?>
	</div>
</div>