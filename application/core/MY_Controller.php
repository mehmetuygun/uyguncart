<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller
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
