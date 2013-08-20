<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller 
{

	public function index()
	{
		$this->load->helper('url');
		$this->load->model('product_model');
		$this->load->library('pagination');

		$config['base_url'] = '?asd=123';
		$config['total_rows'] = 40;
		$config['per_page'] = 10; 
		$config['page_query_string'] = TRUE;
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['next_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';


 
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

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('body', $data);
	}

	public function test($n1 = null, $n2 = null, $n3 = null, $n4 = null)
	{
		$this->load->helper('url');
		echo $n1.' '.$n2.' '. $n3.' '. $n4;
		echo current_url();
	}
}
