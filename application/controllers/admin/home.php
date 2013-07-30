<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function Index()
	{
		$this->load->model('User_model');
		$this->load->library('session');
		$this->User_model->admin_logged();

		$data = array(
			'base_url' => $this->load->helper('url'),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'last' => 'Dashboard'
			),
			'mainview' => 'home',
			'fullname' => $this->session->userdata('userFullName')
		);

		$this->load->view('admin/default', $data);
	}
}