<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends CI_Controller
{

	public function index() 
	{
		$this->load->helper('url');
		redirect('/admin/manufacturer/view', 'location', 301);
	}

	public function view() {
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Manufacturer_model');
		$this->load->library('form_validation');

		$this->User_model->admin_logged();

		$data = array(
			'base_url' => $this->load->helper(array('form', 'url')),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/manufacturer' => 'Manufacturer',
				'last' => 'View'
			),
			'menu_active' => 'catalog',
			'mainview' => 'manufacturer',
			'fullname' => $this->session->userdata('userFullName'),
			'js' => array('public/js/view.js'),
			'manufacturers' => $this->Manufacturer_model->fetch('', 'asc', 10, 1),
			'entries' => $this->Manufacturer_model->entries,
			'pagecount' => $this->Manufacturer_model->pagecount
		);

		$this->load->view('admin/default', $data);
	}

	public function insert() 
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Manufacturer_model');
		$this->load->library('form_validation');

		$this->User_model->admin_logged();

		$this->form_validation->set_rules('manufacturer', 'Manufacturer', 'required|min_length[3]|max_length[45]|alpha|is_unique[manufacturer.manufacturerName]');
		$this->form_validation->set_error_delimiters('', '');

		$data = array(
			'base_url' => $this->load->helper(array('form', 'url')),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/manufacturer' => 'Manufacturer',
				'last' => 'Insert'
			),
			'menu_active' => 'catalog',
			'mainview' => 'manufacturer_insert',
			'fullname' => $this->session->userdata('userFullName'),
		);

		if($this->form_validation->run() == TRUE)
		{
			$field = array("manufacturerName" => $this->input->post('manufacturer'));
			if($this->Manufacturer_model->insert($field)){
				$data["alert_message"] = "The manufacturer is inserted.";
				$data["alert_class"] = "alert-success";
			} else {
				$data["alert_message"] = "Something went wrong.";
				$data["alert_class"] = "alert-error";
			}
		}

		$this->load->view('admin/default', $data);
	}

	public function edit($id) 
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Manufacturer_model');
		$this->load->library('form_validation');

		$this->User_model->admin_logged();

		$this->Manufacturer_model->set($id);
		if ($this->Manufacturer_model->manufacturerName != $this->input->post('manufacturer')) {
			$this->form_validation->set_rules('manufacturer', 'Manufacturer', 'required|min_length[3]|max_length[45]|alpha|is_unique[manufacturer.manufacturerName]');
			$this->form_validation->set_error_delimiters('', '');
		}

		$data = array(
			'base_url' => $this->load->helper(array('form', 'url')),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/manufacturer' => 'Manufacturer',
				'last' => 'Edit'
			),
			'menu_active' => 'catalog',
			'mainview' => 'manufacturer_edit',
			'fullname' => $this->session->userdata('userFullName'),
		);

		if ($this->form_validation->run() === true) {
			$field = array("manufacturerName" => $this->input->post('manufacturer'));
			if($this->Manufacturer_model->update($field, $id)){
				$data["alert_message"] = "The manufacturer is updated.";
				$data["alert_class"] = "alert-success";
			} else {
				$data["alert_message"] = "Something went wrong.";
				$data["alert_class"] = "alert-error";
			}
		}

		$data['manufacturer'] = $this->Manufacturer_model->manufacturerName;

		$this->load->view('admin/default', $data);
	}

	public function ajax() 
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Manufacturer_model');
		$this->User_model->admin_logged();

		$search = $this->input->post('search');
		$page = $this->input->post('page');

		$manufacturers = $this->Manufacturer_model->fetch($search, 'asc', 10, $page);

		$page = array($this->Manufacturer_model->pagecount, $page,$this->Manufacturer_model->entries);
		$array = array($manufacturers, $page);
		echo json_encode($array);
	}

	public function delete() 
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Manufacturer_model');
		$this->User_model->admin_logged();

		$list = $this->input->post('list');

		foreach ($list as $value) {
			$this->Manufacturer_model->delete(array('manufacturerID'=>$value));
		}
	}
}
