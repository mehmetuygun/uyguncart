<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Main_Controller
{
	public function index()
	{
		$this->load->model('Category_model');
		$this->load->model('Product_model');

		$data = array(
			'mainview' => 'index',
			'title' => 'Home',
			'categories' => $this->Category_model->group_by_parent(true),
			'products' => $this->latest_added_product(),
		);

		$this->load_view($data);
	}
}
