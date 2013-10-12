<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Main_Controller
{
	public function index()
	{
		$this->load->model('Category_model');
		$this->load->model('Product_model');

		$params = array(
			'search_term' => '',
			'order_by' => 'added_date',
			'sort' => 'desc',
			'limit' => 9,
		);

		$data = array(
			'mainview' => 'index',
			'title' => 'Home',
			'categories' => $this->Category_model->group_by_parent(true),
			'products' => $this->Product_model->fetch($params),
		);

		$this->load_view($data);
	}
}
