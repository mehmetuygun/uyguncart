<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#" onclick="return false">Order</a>
	</div>
</div>
<span class="pull-left"><input type="text" name="search" placeholder="Search" class="span4"></span>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>User ID</th>
			<th>Total Price</th>
			<th>Shipping Address</th>
			<th>Order Date</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
<span class="pull-left" id="show_info"></span>
<div class="pagination pull-right" style="margin:0"></div>
<span class="clearfix"></span>
<script type="text/javascript">
	function draw_table(data) {
		var html = "";
		for (var i = 0; i < data.length; i++) {
			html += '<tr>';
			html += '<td>'+data[i]['user_id']+'</td>';
			html += '<td>'+data[i]['total_price']+'</td>';
			html += '<td>'+data[i]['shipping_address']+'</td>';
			html += '<td>'+data[i]['added_date']+'</td>';
			html += '</tr>';
		}
		$(".table tbody").html(html);
	}
</script>
<hr>
