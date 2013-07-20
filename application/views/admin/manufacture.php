<div class="navbar">
  	<div class="navbar-inner">
    	<a class="brand" href="#">Manufacturer</a>
    	<span class="pull-right">
    		<a class="btn btn-inverse" href="<?php echo base_url('admin/manufacturer/insert') ?>">Insert</a>
    		<a class="btn btn-danger" href="#">Remove</a>
    	</span>
  	</div>
</div>
<span class="pull-left"><input type="text" name="search" placeholder="Search" class="span4"></span>
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
<span>Display <select name="limit" class="span2"><option>10</option><option>25</option><option>50</option><option>100</option></select> records.</span>