<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{

	public function index() {
		$this->load->helper('url');
		redirect('/admin/category/view', 'location', 301);
	}

	public function view() {
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->library('form_validation');

		$this->User_model->admin_logged();

		$data = array(
			'base_url' => $this->load->helper(array('form', 'url')),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/category' => 'Category',
				'last' => 'View'
			),
			'menu_active' => 'catalog',
			'mainview' => 'category',
			'fullname' => $this->session->userdata('userFullName'),
			'js' => array('public/js/pagination.js', 'public/js/category_view.js'),
		);

		$this->load->view('admin/default', $data);
	}

}
