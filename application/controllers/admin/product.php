<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index() 
	{
		$this->load->helper('url');
		redirect('/admin/product/view', 'location', 301);
	}

	public function view() 
	{
		$this->load->library('session');
		$this->load->model('User_model');

		$this->User_model->admin_logged();

		$data = array(
			'base_url' => $this->load->helper('url'),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/product' => 'Product',
				'last' => 'View'
			),
			'menu_active' => 'catalog',
			'mainview' => 'product',
			'fullname' => $this->session->userdata('userFullName'),
			'js' => array('public/js/view.js'),
		);

		$this->load->view('admin/default', $data);
	}

	public function add()
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Category_model');
		$this->load->model('Manufacturer_model');
		$this->load->model('Product_model');
		$this->load->library('form_validation');

		$this->User_model->admin_logged();

		$data = array(
			'base_url' => $this->load->helper(array('form', 'url')),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/product' => 'Product',
				'last' => 'Add'
			),
			'menu_active' => 'catalog',
			'mainview' => 'product_add',
			'fullname' => $this->session->userdata('userFullName'),
			'categories' => $this->Category_model->fetchAll(true),
			'manufacturer' => $this->Manufacturer_model->fetchAll(true),
		);
		if ($this->input->post('categoryID') != NULL) {
			$this->form_validation->set_rules(
				'categoryID',
				'Category',
				'required|exists[category.categoryID]'
			);
		}
		
		if ($this->input->post('manufacturerID') != NULL) {
			$this->form_validation->set_rules(
				'manufacturerID',
				'Manufacturer',
				'required|exists[manufacturer.manufacturerID]'
			);
		}

		$this->form_validation->set_rules(
			'productName',
			'Product',
			'required|min_length[3]|max_length[75]|alpha_dash_space|is_unique[manufacturer.manufacturerName]'
		);

		if($this->form_validation->run() == TRUE) {
			$field = array(
				'productName'=> $this->input->post('productName'),
				'categoryID'=> $this->input->post('categoryID'),
				'manufacturerID'=> $this->input->post('manufacturerID')
			);
			if($this->Product_model->add($field)) {
				redirect('/admin/product/edit/'.$this->Product_model->insert_id(), 'location');
			} else {
				$data["alert_message"] = "Something went wrong. Please try again.";
				$data["alert_class"] = "alert-error";
			}
		}

		$this->load->view('admin/default', $data);
	}

	public function edit($id)
	{
		$this->load->library('session');
		$this->load->model('User_model');

		$this->User_model->admin_logged();

		$data = array(
			'base_url' => $this->load->helper('url'),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/product' => 'Product',
				'last' => 'Edit'
			),
			'menu_active' => 'catalog',
			'mainview' => 'product_edit',
			'fullname' => $this->session->userdata('userFullName'),
		);

		$this->load->view('admin/default', $data);
	}
}
