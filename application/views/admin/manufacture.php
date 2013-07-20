<div class="navbar">
  	<div class="navbar-inner">
    	<a class="brand" href="#">Manufacturer</a>
    	<span class="pull-right">
    		<a class="btn btn-inverse" href="<?php echo base_url('admin/manufacturer/insert') ?>">Insert</a>
    		<a class="btn btn-danger" href="#">Remove</a>
    	</span>
  	</div>
</div>
Display <select class="span1"><option>10</option></select> records.
<span class="pull-right">Search: <input type="text" name="search"></span>
<table class="table table-bordered">
	<thead>
		<th style="width:20px"><input type="checkbox" name="check_all"></th>
		<th>Manufacturer</th>
		<th style="width:100px"></th>
	</thead>
	<tbody>
		<?php
		foreach ($manufacturers as $row) {
			echo '<tr>
			<td><input type="checkbox" value="'.$row->manufacturerID.'"/></td>
			<td>'.$row->manufacturerName.'</td>
			<td><a class="btn" href="'.base_url("admin/Manufacturer/edit/".$row->manufacturerID).'">Edit</a></td>
			</tr>';
		}
		?>
	</tbody>
</table>