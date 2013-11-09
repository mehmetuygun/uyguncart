<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
	public function output_json(array $array)
	{
		header('Content-Type: application/json');

		echo json_encode($array);
	}

	public function load_model($models)
	{
		if (!is_array($models)) {
			$models = array($models);
		}

		foreach ($models as $model) {
			$this->load->model($model . '_model');
		}
	}
}

class Admin_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('User_model');

		$this->User_model->admin_logged();
	}

	public function load_view($data = array())
	{
		$this->load->helper(array('url', 'uc_helper'));

		$data['fullname'] = $this->session->userdata('userFullName');
		$data['title'] = make_title(array($data['title'], 'Admin Panel'));

		$this->load->view('admin/default', $data);
	}
}

class Main_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->library('cart');
	}

	public function load_view($data = array())
	{
		$this->load->helper(array('url', 'uc_helper'));

		if ($this->session->userdata('userLoggedIn')) {
			$data['user'] = array(
				'FirstName' => $this->session->userdata('userFirstName'),
				'LastName' => $this->session->userdata('userLastName'),
				'FullName' => $this->session->userdata('userFullName'),
				'LoggedIn' => $this->session->userdata('userLoggedIn'),
				'ID' => $this->session->userdata('userID')
			);
		}

		$data['cart_item_count'] = $this->cart->total_items();
		$data['title'] = make_title($data['title']);

		$this->load->view('body', $data);
	}

	public function redirect_user($url)
	{
		$this->load->library('session');
		$this->load->helper('url');
		if(!$this->session->userdata('userLoggedIn')) {
			redirect(base_url().$url);
		}
	}

	public function get_latest_products() {
		$this->load->model('Product_model');
		
		$params = array(
			'search_term' => '',
			'order_by' => 'added_date',
			'filter' => array('status' => 1),
			'sort' => 'desc',
			'limit' => 9,
		);

		return $this->output_json($this->Product_model->fetch($params));
	}
}
