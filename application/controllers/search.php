<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller 
{

	public function index()
	{
		$this->load->helper('url');
		$this->load->model('product_model');
		$data = array(
			'mainview' => 'search'
		);

		$rules = array();
		$page = $this->input->get('page');
		if(isset($page))
			$rules['page'] = $page;
		else 
			$rules['page'] = 1;

		$order_by = $this->input->get('orderby');

		if(isset($order_by) and $order_by == 'name')
			$rules['order_by'] = 'productName';
		else
			$rules['order_by'] = 'productPrice';

		$data['products'] = $this->product_model->fetch($rules);

		$this->load->view('body', $data);
	}

	public function test()
	{
		$this->load->helper('url');
		$this->load->model('product_model');
		var_dump($this->product_model->fetch());

	}
}
