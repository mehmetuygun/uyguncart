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
			'js' => array('display_products.js', 'filter.js'),
		);

		$this->load_view($data);
	}

	public function ajax()
	{
		$select = $this->input->post('select');
		if($select == 'latestproduct') {
			return $this->get_latest_products();
		}
	}
}
