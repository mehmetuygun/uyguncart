<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('/admin/test');
	}

	public function upload()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->model('Product_model');
		$this->Product_model->set(3);

		$this->Product_model->upload_image('image');
	}
}
