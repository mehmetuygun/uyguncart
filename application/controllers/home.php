<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Main_Controller {

	public function index()
	{
		$this->load->helper('url');
		$data['mainview'] = 'index';
		
		$this->load_view($data);
	}
}
