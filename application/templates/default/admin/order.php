<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#" onclick="return false">Order</a>
	</div>
</div>
<span class="pull-left"><input type="text" name="search" placeholder="Search" class="span4"></span>
<table class="table table-bordered" id="OrderTable">
	<thead>
		<tr>
			<th>User ID</th>
			<th>Customer</th>
			<th>Total Price</th>
			<th>Order Added Date</th>
			<th>Action</th>
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
			html += '<td>'+data[i]['first_name']+' '+data[i]['last_name']+'</td>';
			html += '<td>$'+data[i]['total_price']+'</td>';
			html += '<td>'+data[i]['added_date']+'</td>';
			html += '<td><a href="#" data-toggle="modal" data-target="#OrderDetail">View</a></td>';
			html += '</tr>';
		}
		$("#OrderTable tbody").html(html);
	}
</script>
<hr>
<!-- Modal -->
<div id="OrderDetail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3 id="myModalLabel">Order Detail</h3>
  	</div>
  	<div class="modal-body">
    	<div class="tabbable"> <!-- Only required for left/right tabs -->
		  	<ul class="nav nav-tabs">
		    	<li class="active"><a href="#order" data-toggle="tab">Order</a></li>
		    	<li><a href="#shipping" data-toggle="tab">Shipping</a></li>
		    	<li><a href="#billing" data-toggle="tab">Billing</a></li>
		    	<li><a href="#items" data-toggle="tab">Items</a></li>
		  	</ul>
		  	<div class="tab-content">
		    	<div class="tab-pane active" id="order">
		      		<dl class="dl-horizontal">
		                <dt>Order ID:</dt>
		                <dd class="order_id"></dd>
		                <dt>Payment Method:</dt>
		                <dd class="payment_method"></dd>
		                <dt>Customer:</dt>
		                <dd class="customer"></dd>
		                <dt>Email:</dt>
		                <dd class="email"></dd>
		                <dt>Total Price:</dt>
		                <dd class="total_price"></dd>
		                <dt>Date Added:</dt>
		                <dd class="date_added"></dd>
                	</dl>
		    	</div>
		    	<div class="tab-pane" id="shipping">
			    	<dl class="dl-horizontal">
		      			<dt>Customer:</dt>
		                <dd class="shipping_customer"></dd>
		                <dt>Country:</dt>
		                <dd class="shipping_country"></dd>
		                <dt>City:</dt>
		                <dd class="shipping_city"></dd>
		                <dt>Shipping Address:</dt>
		                <dd class="shipping_address"></dd>
	                </dl>
		    	</div>			    	
		    	<div class="tab-pane" id="billing">
			    	<dl class="dl-horizontal">
		      			<dt>Customer:</dt>
		                <dd class="shipping_customer"></dd>
		                <dt>Country:</dt>
		                <dd class="shipping_country"></dd>
		                <dt>City:</dt>
		                <dd class="shipping_city"></dd>
		                <dt>Shipping Address:</dt>
		                <dd class="shipping_address"></dd>
	                </dl>
		    	</div>		    	
		    	<div class="tab-pane" id="items">
		      		<table class="table table-bordered" id="items_table">
                    	<thead>
							<tr>
								<th>Product</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Sub Total</th>
							</tr>
                    	</thead>
                    	<tbody>
                    	</tbody>
                	</table>
		    	</div>
		  	</div>
		</div>
  	</div>
  	<div class="modal-footer">
    	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  	</div>
</div>