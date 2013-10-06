<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('make_title')) {
	function make_title($title)
	{
		if (!is_array($title)) {
			$title = array($title);
		}

		$title[] = 'UygunCart';
		$sep = ' - ';

		return implode($sep, $title);
	}
}
