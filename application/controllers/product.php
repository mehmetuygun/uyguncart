<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Main_Controller
{
	public function index()
	{
		$this->load->helper('url');
		redirect();
	}

	public function id($id)
	{
		$this->load->model('Product_model');
		$this->load->model('Category_model');

		$product = $this->Product_model->set($id);
		$images = $this->Product_model->get_images();

		usort($images, function($a, $b) {
			return (int) $b['default'];
		});

		$data = array(
			'mainview' => 'product',
			'title' => $this->Product_model->name,
			'row' => $product,
			'cat_path' => $this->Category_model->get_path($product->category_id),
			'images' => $images,
			'js' => array('product.js'),
		);

		$this->load_view($data);
	}
}
