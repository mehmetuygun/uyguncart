<form action="<?php echo base_url('/admin/product/upload_image') ?>"
	method="post" enctype="multipart/form-data">
	<input name="productID" type="hidden" value="<?php echo $productID ?>" />
	<input name="image" type="file" />
</form>
