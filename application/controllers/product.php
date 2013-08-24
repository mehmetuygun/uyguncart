<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('index');
	}
	public function id($id)
	{
		$this->load->helper('url');
		$this->load->model('product_model');

		$data = array(
			'mainview' => 'product',
			'row' => $this->product_model->set($id),
			'img' => $this->product_model->get_images(true)
		);

		$this->load->view('body', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */