<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Admin_Controller
{
	public function __construct() {
		parent::__construct();

		$this->load->model('Product_model');
	}

	public function index()
	{
		$this->load->helper('url');
		redirect('/admin/product/view', 'location', 301);
	}

	public function view()
	{
		$data = array(
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/product' => 'Product',
				'last' => 'View'
			),
			'menu_active' => 'catalog',
			'mainview' => 'product',
			'products' => $this->Product_model->fetch(),
			'entries'=> $this->Product_model->entries,
			'pagecount'=> $this->Product_model->pagecount,
			'js' => array('public/js/view.js'),
		);

		$this->load_view($data);
	}

	public function add()
	{
		$this->load_model(array('Category', 'Manufacturer'));
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data = array(
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/product' => 'Product',
				'last' => 'Add'
			),
			'menu_active' => 'catalog',
			'mainview' => 'product_add',
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
			'required|min_length[3]|max_length[75]|alpha_dash_space|is_unique[product.productName]'
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

		$this->load_view($data);
	}

	public function edit($id)
	{
		$this->load->library('form_validation');
		$this->load_model(array('Category', 'Manufacturer'));
		$this->load->helper('form');

		$data = array(
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/product' => 'Product',
				'last' => 'Edit'
			),
			'menu_active' => 'catalog',
			'mainview' => 'product_edit',
			'js' => array('public/js/tinymce/tinymce.min.js','public/js/product_edit.js'),
			'status' => array(0 => 'Disabled', 1 => 'Enabled'),
			'categories' => $this->Category_model->fetchAll(true),
			'manufacturers' => $this->Manufacturer_model->fetchAll(true),
			'product' => $this->Product_model->set($id),
		);

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$update = array();

			$fields = array(
				array(
					'field' => 'productName',
					'label' => 'Product Name',
					'rules' => 'required|is_unique[product.productName]',
				),
				array(
					'field' => 'categoryID',
					'label' => 'Category',
					'rules' => 'exists_null[category.categoryID]',
				),
				array(
					'field' => 'manufacturerID',
					'label' => 'Manufacturer',
					'rules' => 'exists_null[manufacturer.manufacturerID]',
				),
				array(
					'field' => 'productPrice',
					'label' => 'Product Price',
					'rules' => 'numeric',
				),
				array(
					'field' => 'productStatus',
					'label' => 'Product Status',
					'rules' => 'status',
				),
				array(
					'field' => 'productDescription',
					'label' => 'Product Description',
					'rules' => 'required',
				),
			);

			foreach ($fields as $field) {
				if ($this->input->post($field['field']) != $this->Product_model->{$field['field']}) {
					$this->form_validation->set_rules(array($field));
					$update[$field['field']] = $this->input->post($field['field']);
				}
			}

			if (empty($update)) {
				$data['alert_message'] = 'Enter data you want to update.';
				$data['alert_class'] = 'alert-error';
			}

			if ($this->form_validation->run() == true) {
				if ($this->Product_model->update($update,$id)) {
					$data['alert_message'] = 'Your data has been updated successfully.';
					$data['alert_class'] = 'alert-success';
				} else {
					$data['alert_message'] = 'Something went wrong.';
					$data['alert_class'] = 'alert-error';
				}
			}
		}

		$this->load_view($data);
	}

	public function delete()
	{
		$list = $this->input->post('list');

		foreach ($list as $value) {
			$this->Product_model->delete(array('productID' => $value));
		}
	}

	public function ajax()
	{
		$search = $this->input->post('search');
		$page = $this->input->post('page');

		$categories = $this->Product_model->fetch($search, 'asc', 10, $page);

		$array = array(
			$categories,
			array(
				$this->Product_model->pagecount,
				$page,
				$this->Product_model->entries
			)
		);

		echo json_encode($array);
	}
}
