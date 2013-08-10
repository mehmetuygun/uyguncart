<!DOCTYPE html>
<html>
<head>
</head>
<body><pre><?php if (isset($test)) echo $test; ?></pre>
	<pre><?php if (isset($test2)) print_r($test2) ?></pre>
	<pre><?php if (isset($errors)) print_r($errors) ?></pre>
	<pre><?php if (isset($resize_errors)) print_r($resize_errors) ?></pre>
	<form action="<?php echo base_url('/admin/test/upload') ?>" method="post" enctype="multipart/form-data">
		<input name="image" type="file" /><br />
		<input type="submit" /><br />
	</form>
</body>
</html>
