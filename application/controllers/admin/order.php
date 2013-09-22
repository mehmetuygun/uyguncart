<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Admin_Controller
{
	public function __construct() {
		parent::__construct();

		$this->load->model('Order_model');
	}

	public function index()
	{
		$this->load->helper('url');
		redirect('/admin/order/view', 'location', 301);
	}

	public function view()
	{
		$data = array(
			'title' => 'Orders',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'last' => 'Orders',
			),
			'menu_active' => 'sales',
			'mainview' => 'order',
			'js' => array('public/js/view.js'),
		);

		$this->load_view($data);
	}

	public function ajax()
	{
		$search = $this->input->post('search');
		$page = $this->input->post('page');

		$params = array(
			'search_term' => $search,
			'order_by' => 'id',
			'sort' => 'desc',
			'page' => $page,
		);

		$orders = $this->Order_model->fetch($params);

		$array = array(
			$orders,
			array(
				$this->Order_model->pagecount,
				$this->Order_model->page,
				$this->Order_model->entries
			)
		);

		$this->output_json($array);
	}
}
