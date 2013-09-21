<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Main_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('index');
	}

	public function id($id)
	{
		$this->load->model('Product_model');

		$product = $this->Product_model->set($id);
		$images = $this->Product_model->get_images();

		usort($images, function($a, $b) {
			return (int) $b['default'];
		});

		$data = array(
			'mainview' => 'product',
			'title' => $this->Product_model->productName,
			'row' => $product,
			'images' => $images,
		);

		$this->load_view($data);
	}
}
