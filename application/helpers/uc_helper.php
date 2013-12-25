<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('make_title')) {
	function make_title()
	{
		$title = func_get_args();

		$title[] = 'UygunCart';
		$sep = ' - ';

		return implode($sep, $title);
	}
}
