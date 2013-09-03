<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$data['mainview'] = 'index';
		$this->load->view('body', $data);
	}
}
