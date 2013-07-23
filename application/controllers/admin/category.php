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
		$this->load->model('Category_model');
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
			'categories' => $this->Category_model->fetch(),
			'entries'=>$this->Category_model->entries,
			'pagecount'=>$this->Category_model->pagecount,
			'js' => array('public/js/pagination.js', 'public/js/category_view.js'),
		);

		$this->load->view('admin/default', $data);
	}

	public function add(){
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Category_model');
		$this->load->library('form_validation');

		$this->User_model->admin_logged();

		$data = array(
			'base_url' => $this->load->helper(array('form', 'url')),
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/category' => 'Category',
				'last' => 'Add'
			),
			'menu_active' => 'catalog',
			'mainview' => 'category_add',
			'fullname' => $this->session->userdata('userFullName'),
			'js' => array('public/js/pagination.js', 'public/js/category_view.js'),
			'categories' => $this->Category_model->fetchAll(true),
		);

		$this->form_validation->set_rules('parentID','Parent Category','category_exist');
		$this->form_validation->set_rules('categoryName','Category','required|min_length[3]|max_length[45]|alpha|is_unique[category.categoryName]');
		$this->form_validation->set_error_delimiters('', '');

		if($this->form_validation->run() == TRUE)
		{	
			$parentID = $this->input->post('parentID');
			if(strlen($parentID)>0)
				$field = array('parentID'=>$this->input->post('parentID'),'categoryName'=>$this->input->post('categoryName'));
			else
				$field = array('categoryName'=>$this->input->post('categoryName'));

			if($this->Category_model->add($field))
			{
				$data["alert_message"] = "The Category is added succesfuly.";
				$data["alert_class"] = "alert-success";
				$data["categories"] = $this->Category_model->fetchAll(true);
			}
			else
			{
				$data["alert_message"] = "Something went wrong. Please try again.";
				$data["alert_class"] = "alert-error";
			}
		}

		$this->load->view('admin/default', $data);
	}

	public function ajax() {
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Category_model');
		$this->User_model->admin_logged();

		$search = $this->input->post('search');
		$page = $this->input->post('page');

		$categories = $this->Category_model->fetch($search, 'asc', 10, $page);

		$page = array($this->Category_model->pagecount, $page,$this->Category_model->entries);
		$array = array($categories, $page);
		echo json_encode($array);
	}

	public function delete() {
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->model('Category_model');
		$this->User_model->admin_logged();

		$list = $this->input->post('list');

		foreach ($list as $value) {
			$this->Category_model->delete($value);
		}
	}
}
