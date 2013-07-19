<ul class="breadcrumb">
	<?php
	foreach ($breadcrumb as $key => $value) {
		if($key=="last")
			echo '<li class="active">'.$value.'</li>';
		else
			echo '<li><a href="'.base_url($key).'">'.$value.'</a><span class="divider">/</span></li>';
	}	
	?>  	
</ul>