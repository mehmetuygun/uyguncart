<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Cart extends CI_Cart
{
	// Don't do any validation against product name
	// becomes:
	// preg_match("/^[y]|.*|[y]+$/i", $items['name'])
	public $product_name_rules	= 'y]|.*|[y';
}
