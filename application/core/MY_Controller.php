<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
	public function output_json(array $array)
	{
		header('Content-Type: application/json');

		echo json_encode($array);
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
		$data['fullname'] = $this->session->userdata('userFullName');

		$this->load->helper('url');
		$this->load->view('admin/default', $data);
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

class Main_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function load_view($data = array())
	{
		$userLoggedIn = $this->session->userdata('userLoggedIn');

		if($userLoggedIn) {
			$data['user'] = array(
				'FirstName' = $this->session->userdata('userFirstName'),
				'LastName' = $this->session->userdata('userLastName'),
				'FullName' = $this->session->userdata('userFullName'),
				'LoggedIn' = $this->session->userdata('userLoggedIn'),
				'ID' = $this->session->userdata('userID')
				);
		}


		$this->load->helper('url');
		$this->load->view('body', $data);
	}
}
