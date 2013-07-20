<div class="navbar">
  	<div class="navbar-inner">
    	<a class="brand" href="#">Manufacturer</a>
    	<span class="pull-right">
    		<a class="btn btn-inverse" href="<?php echo base_url('admin/manufacturer/insert') ?>">Insert</a>
    		<a class="btn btn-danger" href="#">Remove</a>
    	</span>
  	</div>
</div>
<table class="table table-bordered">
	<thead>
		<th>Manufacturer</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		foreach ($manufacturers as $row) {
			echo '<tr><td>'.$row->manufacturerName.'</td><td></td></tr>';
		}
		?>
	</tbody>
</table>