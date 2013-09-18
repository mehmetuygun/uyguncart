<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">Manufacturer</a>
	</div>
</div>
<span class="pull-left"><input type="text" name="search" placeholder="Search" class="span4"></span>
<span class="pull-right">
	<a class="btn" href="<?php echo base_url('admin/manufacturer/add') ?>">Add</a>
	<a class="btn btn-danger" href="#" onclick="return false" id="delete">Delete</a>
</span>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:20px"><input type="checkbox" name="check_all" onclick="check_all(this)"></th>
			<th>Manufacturer</th>
			<th style="width:100px"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($manufacturers as $row) {
			echo '<tr>
			<td><input type="checkbox" name="check[]" class="check"  value="'.$row['manufacturerID'].'"/></td>
			<td>'.$row['manufacturerName'].'</td>
			<td><a class="link" href="'.base_url("admin/manufacturer/edit/".$row['manufacturerID']).'">Edit</a>&nbsp;<a class="link delete_one" href="#'.$row['manufacturerID'].'" onclick="return false">Delete</a></td>
			</tr>';
		}
		?>
	</tbody>
</table>
<span class="pull-left" id="show_info"></span>
<div class="pagination pull-right" style="margin:0"></div>
<span class="clearfix"></span>
<script type="text/javascript">
	function draw_table(data) {
		var html = "";
		for (var i = 0; i < data.length; i++) {
			html += '<tr>';
			html += '<td><input type="checkbox" value="'+data[i]['manufacturerID']+'" class="check"></td>';
			html += '<td>'+data[i]['manufacturerName']+'</td>';
			html += '<td><a class="link" href="edit/'+data[i]['manufacturerID']+'">Edit</a>&nbsp;';
			html += '<a class="link delete_one" href="#'+data[i]['manufacturerID']+'">Delete</a></td>';
			html += '</tr>';
		}
		$(".table tbody").html(html);
	}
</script>
<hr>
