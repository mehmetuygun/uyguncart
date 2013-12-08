<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
	public function __construct()
	{
		parent::__construct();

		$this->config('uyguncart');

		$CI =& get_instance();
		$template = $CI->config->item('template');

		$this->_ci_view_paths = array(APPPATH . 'templates/' . $template . '/' => true);
	}
}
