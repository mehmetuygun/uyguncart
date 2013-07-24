<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function Index()
	{
		$this->load->model('User_model');
		$this->load->library('session');
		$data["base_url"] = $this->load->helper('url');

		$data["title"] = "UygunCart";
		$data["breadcrumb"] = array("last"=>"Dashboard");
		$data["fullname"] = $this->session->userdata('name');

		$data["mainview"] = "home";
		$this->load->library('session');
		$data["fullname"] = $this->session->userdata('userFullName');

		$this->load->view('admin/default', $data);
		$this->User_model->admin_logged();
	}
}