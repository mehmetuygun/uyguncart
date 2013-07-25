<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#" onclick="return false">Category</a>
	</div>
</div>
<span class="pull-left"><input type="text" name="search" placeholder="Search" class="span4"></span>
<span class="pull-right">
	<a class="btn" href="<?php echo base_url('admin/category/add') ?>">Add</a>
	<a class="btn btn-danger" href="#" onclick="return false" id="delete">Delete</a>
</span>
<table class="table table-bordered">
	<thead>
		<th style="width:20px"><input type="checkbox" name="check_all" onclick="check_all(this)"></th>
		<th>Category</th>
		<th style="width:100px"></th>
	</thead>
	<tbody>
		<?php
		foreach ($categories as $category) {
			$edit_url = base_url("admin/category/edit/{$category['categoryID']}");
			echo <<<HTML
		<tr>
			<td><input name="check[]" type="checkbox" value="{$category['categoryID']}" /></td>
			<td>{$category['categoryName']}</td>
			<td valign="middle">
				<a class="link" href="$edit_url">Edit</a>
				<a class="link delete_one" href="#{$category['categoryID']}" onclick="return false">Delete</a>
			</td>
		</tr>
HTML;
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
		if ($pagecount > 5) $pagecount = 5;
		for ($i=2; $i <= $pagecount ; $i++) { 
			echo '<li><a href="#'.$i.'"   onclick="return false">'.$i.'</a></li>';
		}
		?>
		<li <?php if($pagecount==1)echo 'class="active"'; ?>><a href="#"  onclick="return false">&raquo;</a></li>
	</ul>
</div>
<span class="clearfix"></span>
<script type="text/javascript">
	function draw_table(data) {
		var html = "";
		for (var i = 0; i < data.length; i++) {
			html += '<tr>';
			html += '<td><input type="checkbox" value="'+data[i]['categoryID']+'" class="check"></td>';
			html += '<td>'+data[i]['categoryName']+'</td>';
			html += '<td><a class="link" href="edit/'+data[i]['categoryID']+'">Edit</a>&nbsp;<a class="link delete_one" href="#'+data[i]['categoryID']+'">Delete</a></td>';
			html += '</tr>';
		}
		$(".table tbody").html(html);
	}
</script>
<hr>
