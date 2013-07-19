<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		redirect('/admin/manufacturer/view', 'location', 301);
	}
	public function view()
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$data["base_url"] = $this->load->helper(array('form', 'url'));
		$data["title"] = "UygunCart";
		$data["breadcrumb"] = array("admin/home"=>"Dashboard","admin/manufacturer"=>"Manufacturer","last"=>"View");
		$data["menu_active"] = "catalog";
		$data["mainview"] = "manufacture";

		$data["fullname"] = $this->session->userdata('userFirstName').' '.$this->session->userdata('userLastName');
		$this->load->view('admin/default',$data);

		$this->User_model->admin_logged();
	}

}