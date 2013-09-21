<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Main_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->library('pagination');

		$page = $this->input->get('page');

		$params = array();
		$params['page'] = isset($page) ? $page : 1;

		$order_by = $this->input->get('orderby');
		switch ($order_by) {
			case 'price_desc':
				$params['sort'] = 'desc';
			case 'price_asc':
				$params['order_by'] = 'productPrice';
				break;
			case 'name':
			default:
				$params['order_by'] = 'productName';
				break;
		}

		$query = $this->input->get('q');
		$params['search_term'] = $query;
		$params['filter'] = array('productStatus' => '1');

		$data = array(
			'mainview' => 'search',
			'title' => $query,
			'products' => $this->product_model->fetch($params),
			'categories' => $this->category_model->group_by_parent(true),
			'entries' => $this->product_model->entries,
			'q' => $query,
			'orderby' => $order_by,
			'page' => $page,
		);

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

		$this->load_view($data);
	}
}
