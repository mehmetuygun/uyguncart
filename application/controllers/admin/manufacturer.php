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
		$this->load->model('Manufacturer_model');
		$this->load->library('form_validation');

		$data["base_url"] = $this->load->helper(array('form', 'url'));
		$data["title"] = "UygunCart";
		$data["breadcrumb"] = array("admin/home"=>"Dashboard","admin/manufacturer"=>"Manufacturer","last"=>"View");
		$data["menu_active"] = "catalog";
		$data["mainview"] = "manufacture";

		var_dump($this->Manufacturer_model->fetch('a','asc',1,3));
		echo $this->db->last_query();

		$data["fullname"] = $this->session->userdata('userFirstName').' '.$this->session->userdata('userLastName');
		$this->load->view('admin/default',$data);

		$this->User_model->admin_logged();
	}

	public function insert()
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Manufacturer_model');
		$this->load->library('form_validation');

		$this->User_model->admin_logged();

		$data["base_url"] = $this->load->helper(array('form', 'url'));
		$data["title"] = "UygunCart";
		$data["breadcrumb"] = array("admin/home"=>"Dashboard","admin/manufacturer"=>"Manufacturer","last"=>"Insert");
		$data["menu_active"] = "catalog";
		$data["mainview"] = "manufacture_insert";

		$this->form_validation->set_rules('manufacturer','Manufacturer','required|min_length[3]|max_length[45]|alpha|is_unique[manufacturer.manufacturerName]');
		$this->form_validation->set_error_delimiters('', '');

		if($this->form_validation->run() == TRUE)
		{
			$field = array("manufacturerName" => $this->input->post('manufacturer'));
			if($this->Manufacturer_model->insert($field)){
				$data["alert_message"] = "The manufacturer is inserted.";
				$data["alert_class"] = "alert-success";
			}
			else{
				$data["alert_message"] = "Something went wrong.";
				$data["alert_class"] = "alert-error";
			}
		}

		$data["fullname"] = $this->session->userdata('userFirstName').' '.$this->session->userdata('userLastName');

		$this->load->view('admin/default',$data);
	}

}