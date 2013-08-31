<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$this->load->model('product_model');
		$this->load->library('pagination');

		$data = array(
			'mainview' => 'search'
		);

		$page = $this->input->get('page');

		$params = array();
		if (isset($page)) {
			$params['page'] = $page;
		} else {
			$params['page'] = 1;
		}

		$order_by = $this->input->get('orderby');
		if (isset($order_by) && $order_by == 'name') {
			$params['order_by'] = 'productName';
		} else {
			$params['order_by'] = 'productPrice';
		}

		$query = $this->input->get('q');
		$params['search_term'] = $query;
		$params['filter'] = array('productStatus' => '1');

		$data['products'] = $this->product_model->fetch($params);

		$config = array(
			'base_url' => base_url('search') . '?q=' . $query . '&orderby=' . $order_by,
			'total_rows' => $this->product_model->entries,
			'per_page' => $this->product_model->limit,
			'page_query_string' => true,
			'first_link' => false,
			'last_link' => false,
			'use_page_numbers' => true,
			'full_tag_open' => '<ul class="pagination pull-right">',
			'full_tag_close' => '</ul>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'next_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'next_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a href="#">',
			'cur_tag_close' => '<span class="sr-only">(current)</span></a></li>',
		);

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
		$data['entries'] = $this->product_model->entries;
		$data['q'] = $query;
		$data['orderby'] = $order_by;
		$data['page'] = $page;

		$this->load->view('body', $data);
	}

	public function test($n1 = null, $n2 = null, $n3 = null, $n4 = null)
	{
		$this->load->helper('url');
		echo $n1.' '.$n2.' '. $n3.' '. $n4;
		echo current_url();
	}
}
