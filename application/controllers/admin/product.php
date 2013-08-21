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

		if ($this->form_validation->run() == true) {
			$field = array(
				'productName'=> $this->input->post('productName'),
				'categoryID'=> $this->input->post('categoryID'),
				'manufacturerID'=> $this->input->post('manufacturerID')
			);
			if ($productID = $this->Product_model->add($field)) {
				redirect('/admin/product/edit/' . $productID);
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
			'js' => array(
				'public/js/tinymce/tinymce.min.js',
				'public/js/product_edit.js',
				'public/js/jquery.form.min.js'
			),
			'status' => array(0 => 'Disabled', 1 => 'Enabled'),
			'categories' => $this->Category_model->fetchAll(true),
			'manufacturers' => $this->Manufacturer_model->fetchAll(true),
		);

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
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
				array(
					'field' => 'defaultImage',
					'label' => 'Default Image',
					'rules' => ''
				)
			);

			$this->Product_model->set($id);
			$update = array();
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
				if ($this->Product_model->update($update, $id)) {
					$data['alert_message'] = 'Your data has been updated successfully.';
					$data['alert_class'] = 'alert-success';
				} else {
					$data['alert_message'] = 'Something went wrong.';
					$data['alert_class'] = 'alert-error';
				}
			}
		}

		$data['product'] = $this->Product_model->set($id);
		$data['productImages'] = $this->Product_model->get_images();
		$this->load_view($data);
	}

	public function get_images($id)
	{
		$this->Product_model->set($id);

		$images = $this->Product_model->get_images();
		$this->output_json($images);
	}

	public function upload_image($id = null)
	{
		if (!isset($id)) {
			$id = $this->input->post('productID');
			$this->Product_model->set($id);

			$res = $this->Product_model->upload_image('image');
			$output = array('success' => true);
			if ($res !== true) {
				$output['success'] = false;
				$output['errors'] = $res;
			}

			$this->output_json($output);
			return;
		}

		$this->load->helper('form');
		$data['productID'] = $id;

		$this->load->view('/admin/product_upload_image', $data);
	}

	public function delete_image($id)
	{
		$this->Product_model->delete_image($id);
	}

	public function delete()
	{
		$list = $this->input->post('list');

		foreach ($list as $id) {
			$this->Product_model->delete($id);
		}
	}

	public function ajax()
	{
		$search = $this->input->post('search');
		$page = $this->input->post('page');

		$params = array(
			'search_term' => $search,
			'order_by' => 'productName',
			'page' => $page,
		);

		$products = $this->Product_model->fetch($params);

		$array = array(
			$products,
			array(
				$this->Product_model->pagecount,
				$this->Product_model->page,
				$this->Product_model->entries
			)
		);

		$this->output_json($array);
	}
}
