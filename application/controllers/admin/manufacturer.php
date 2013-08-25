<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends Admin_Controller
{
	public function __construct() {
		parent::__construct();

		$this->load->model('Manufacturer_model');
	}

	public function index()
	{
		$this->load->helper('url');
		redirect('/admin/manufacturer/view', 'location', 301);
	}

	public function view()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data = array(
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/manufacturer' => 'Manufacturer',
				'last' => 'View'
			),
			'menu_active' => 'catalog',
			'mainview' => 'manufacturer',
			'js' => array('public/js/view.js'),
			'manufacturers' => $this->Manufacturer_model->fetch(),
			'entries' => $this->Manufacturer_model->entries,
			'pagecount' => $this->Manufacturer_model->pagecount
		);

		$this->load_view( $data);
	}

	public function add()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules(
			'manufacturer',
			'Manufacturer',
			'required|min_length[3]|max_length[45]|alpha|is_unique[manufacturer.manufacturerName]'
		);

		$data = array(
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/manufacturer' => 'Manufacturer',
				'last' => 'Add'
			),
			'menu_active' => 'catalog',
			'mainview' => 'manufacturer_add',
		);

		if ($this->form_validation->run() == true)
		{
			$field = array("manufacturerName" => $this->input->post('manufacturer'));
			if($this->Manufacturer_model->insert($field)){
				$data["alert_message"] = "The manufacturer is added successfully.";
				$data["alert_class"] = "alert-success";
			} else {
				$data["alert_message"] = "Something went wrong.";
				$data["alert_class"] = "alert-error";
			}
		}

		$this->load_view($data);
	}

	public function edit($id)
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->Manufacturer_model->set($id);
		if ($this->Manufacturer_model->manufacturerName != $this->input->post('manufacturer')) {
			$this->form_validation->set_rules(
				'manufacturer',
				'Manufacturer',
				'required|min_length[3]|max_length[45]|alpha|is_unique[manufacturer.manufacturerName]'
			);
		}

		$data = array(
			'title' => 'UygunCart',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/manufacturer' => 'Manufacturer',
				'last' => 'Edit'
			),
			'menu_active' => 'catalog',
			'mainview' => 'manufacturer_edit',
		);

		if ($this->form_validation->run() == true) {
			$field = array("manufacturerName" => $this->input->post('manufacturer'));
			if ($this->Manufacturer_model->update($field, $id)) {
				$data["alert_message"] = "The manufacturer is updated.";
				$data["alert_class"] = "alert-success";
			} else {
				$data["alert_message"] = "Something went wrong.";
				$data["alert_class"] = "alert-error";
			}
		}

		$data['manufacturer'] = $this->Manufacturer_model->manufacturerName;

		$this->load_view($data);
	}

	public function delete()
	{
		$list = $this->input->post('list');

		foreach ($list as $value) {
			$this->Manufacturer_model->delete($value);
		}
	}

	public function ajax()
	{
		$search = $this->input->post('search');
		$page = $this->input->post('page');

		$params = array(
			'search_term' => $search,
			'order_by' => 'manufacturerName',
			'page' => $page,
		);

		$manufacturers = $this->Manufacturer_model->fetch($params);

		$array = array(
			$manufacturers,
			array(
				$this->Manufacturer_model->pagecount,
				$this->Manufacturer_model->page,
				$this->Manufacturer_model->entries
			)
		);

		$this->output_json($array);
	}
}
