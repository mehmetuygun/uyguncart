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
			'js' => array('view.js'),
		);

		$this->load_view($data);
	}

	public function ajax()
	{
		$search = $this->input->post('search');
		$page = $this->input->post('page');

		$params = array(
			'search_term' => $search,
			'order_by' => 'order_id',
			'sort' => 'desc',
			'page' => $page,
			'join' => array('user', 'user.user_id = order.user_id'),
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

	public function get_order($order_id)
	{

		$params = array(
			'select'	=>	array('user.user_id', 
				'user.first_name', 
				'user.last_name',
				'user.email',
				'order.total_price',
				'order.added_date',
				'order.order_id',
				),
			'join'		=> 	array('user', 'user.user_id = order.user_id'),
			'filter' => array('order_id' => $order_id),
		);

		$order = $this->Order_model->fetch($params);
		$this->Order_model->clear();

		$params = array(
			'select' => array(
				'user.first_name',
				'user.last_name',
				'order.order_id',
				'country.name',
				'address.city',
				'address.full_name',
				'address.address1',
				'address.address2',
				'address.postcode',
			),
			'join' => array(
				array('address', 'order.shipping_address = address.address_id'),
				array('country', 'country.country_id = address.country_id'),
				array('user', 'user.user_id = order.user_id'),
			),
			'filter' => array('order.order_id' => $order_id),
		);

		$shipping = $this->Order_model->fetch($params);
		$this->Order_model->clear();

		$params = array(
			'select' => array(
				'user.first_name',
				'user.last_name',
				'order.order_id',
				'country.name',
				'address.city',
				'address.full_name',
				'address.address1',
				'address.address2',
				'address.postcode',
			),
			'join' => array(
				array('address', 'order.billing_address = address.address_id'),
				array('country', 'country.country_id = address.country_id'),
				array('user', 'user.user_id = order.user_id'),
			),
			'filter' => array('order.order_id' => $order_id),
		);

		$billing = $this->Order_model->fetch($params);
		$this->Order_model->clear();

		$items_array = array(
			'select' => array('item_id', 'product_id', 'name', 'quantity', 'unit_price'),
			'join' => array(
				array('order_item', 'order.order_id = order_item.order_id'),
			),
			'filter' => array('order.order_id' => $order_id),
		);

		$items = $this->Order_model->fetch($items_array);

		$data = array('order' => $order, 'shipping' => $shipping, 'billing' => $billing, 'items' => $items);

		$this->load->view('admin/order_detail', $data);
	}
}
