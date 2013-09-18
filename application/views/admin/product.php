<div class="navbar">
  	<div class="navbar-inner">
    	<a class="brand" href="#" onclick="return false">Product</a>
  	</div>
</div>
<span class="pull-left"><input type="text" name="search" placeholder="Search" class="span4"></span>
<span class="pull-right">
	<a class="btn" href="<?php echo base_url('admin/product/add') ?>">Add</a>
	<a class="btn btn-danger" href="#" onclick="return false" id="delete">Delete</a>
</span>
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width:20px"><input type="checkbox" name="check_all" onclick="check_all(this)"></th>
            <th>Product</th>
            <th style="width:100px"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($products as $product) {
            $edit_url = base_url("admin/product/edit/{$product['productID']}");
            echo <<<HTML
        <tr>
            <td><input name="check[]" type="checkbox" value="{$product['productID']}" /></td>
            <td>{$product['productName']}</td>
            <td valign="middle">
                <a class="link" href="$edit_url">Edit</a>
                <a class="link delete_one" href="#{$product['productID']}" onclick="return false">Delete</a>
            </td>
        </tr>
HTML;
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
            html += '<td><input type="checkbox" value="'+data[i]['productID']+'" class="check"></td>';
            html += '<td>'+data[i]['productName']+'</td>';
            html += '<td><a class="link" href="edit/'+data[i]['productID']+'">Edit</a>&nbsp;<a class="link delete_one" href="#'+data[i]['productID']+'">Delete</a></td>';
            html += '</tr>';
        }
        $(".table tbody").html(html);
    }
</script>
<hr>
