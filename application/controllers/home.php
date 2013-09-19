<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Main_Controller
{
	public function index()
	{
		$this->load->model('Category_model');

		$data = array(
			'mainview' => 'index',
			'categories' => $this->Category_model->group_by_parent(true),
		);

		$this->load_view($data);
	}
}
