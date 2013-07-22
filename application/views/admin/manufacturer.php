<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">Manufacturer</a>
	</div>
</div>
<span class="pull-left"><input type="text" name="search" placeholder="Search" class="span4"></span>
<span class="pull-right">
	<a class="btn" href="<?php echo base_url('admin/manufacturer/insert') ?>">Add</a>
	<a class="btn btn-danger" href="#" onclick="return false" id="delete">Delete</a>
</span>
<table class="table table-bordered">
	<thead>
		<th style="width:20px"><input type="checkbox" name="check_all" onclick="check_all(this)"></th>
		<th>Manufacturer</th>
		<th style="width:100px"></th>
	</thead>
	<tbody>
		<?php
		foreach ($manufacturers as $row) {
			echo '<tr>
			<td><input type="checkbox" name="check[]" class="check"  value="'.$row->manufacturerID.'"/></td>
			<td>'.$row->manufacturerName.'</td>
			<td><a class="link" href="'.base_url("admin/manufacturer/edit/".$row->manufacturerID).'">Edit</a>&nbsp;<a class="link delete_one" href="#'.$row->manufacturerID.'" onclick="return false">Delete</a></td>
			</tr>';
		}
		?>
	</tbody>
</table>
<span class="pull-left" id="show_info">Showing 1 to 10 of <?php echo $entries; ?> entries.</span>
<div class="pagination pull-right" style="margin:0">
	<ul>
		<li class="active"><a href="#" onclick="return false">&laquo;</a></li>
		<li class="active"><a href="#1" onclick="return false">1</a></li>
		<?php 
		if($pagecount>5)
			$pagecount = 5;
		for ($i=2; $i <= $pagecount ; $i++) { 
			echo '<li><a href="#'.$i.'"   onclick="return false">'.$i.'</a></li>';
		}
		?>
		<li><a href="#" onclick="return false">&raquo;</a></li>
	</ul>
</div>
<span class="clearfix"></span>
<hr>
