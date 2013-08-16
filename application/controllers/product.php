<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('index');
	}
	public function id($id, $name)
	{
		$this->load->helper('url');
		$data = array(
			'mainview' => 'product',
			'product' => null
		);

		$this->load->view('body', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */