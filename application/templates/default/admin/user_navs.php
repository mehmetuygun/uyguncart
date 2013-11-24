<ul class="nav nav-tabs nav-stacked">
<?php
foreach ($side_nav as $url => $details) {
	$class = '';
	if ($this->router->method == $details['method']) {
		$class = ' class="active"';
	}
	echo '<li', $class, '>',
		'<a href="', base_url($url), '">', $details['label'], '</a>',
		'</li>';
}
?>
</ul>
