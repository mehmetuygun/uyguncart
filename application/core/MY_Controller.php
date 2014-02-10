<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
	/**
	 * Adds content type json header and prints out json encoded version
	 *
	 * @param  array  $array Array to be json encoded
	 *
	 * @return void
	 */
	public function output_json(array $array)
	{
		header('Content-Type: application/json');

		echo json_encode($array);
	}

	/**
	 * Loads list of models into the controller
	 *
	 * @param  mixed $models Name of the model or array of model names
	 *
	 * @return void
	 */
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

	/**
	 * Load default view using the data provided
	 *
	 * @param  array  $data Data to be provided to the view
	 *
	 * @return void
	 */
	public function load_view($data = array())
	{
		$this->load->helper(array('url', 'uc_helper'));

		$data['fullname'] = $this->session->userdata('userFullName');
		$data['title'] = make_title($data['title'], 'Admin Panel');

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

	/**
	 * Load default view using the data provided
	 *
	 * @param  array  $data Data to be provided to the view
	 *
	 * @return void
	 */
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

	/**
	 * Check if the user is logged in and redirect to specified url otherwise
	 *
	 * @param  string $url Url to redirect to
	 *
	 * @return void
	 */
	public function redirect_user($url)
	{
		$this->load->helper('url');
		if(!$this->session->userdata('userLoggedIn')) {
			redirect($url);
		}
	}

	/**
	 * Outputs 9 recently added products as JSON
	 *
	 * @return void
	 */
	public function get_latest_products() {
		$this->load->model('Product_model');
		
		$params = array(
			'order_by' => 'added_date',
			'filter' => array('status' => 1),
			'sort' => 'desc',
			'limit' => 9,
		);

		$products = $this->Product_model->fetch($params);
		array_walk($products, function (&$product) {
			$product['price'] = number_format($product['price'], 2);
		});

		$this->output_json($products);
	}
}
