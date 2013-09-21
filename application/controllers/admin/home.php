<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Admin_Controller
{
	public function Index()
	{
		$data = array(
			'title' => 'Home',
			'breadcrumb' => array(
				'last' => 'Dashboard'
			),
			'mainview' => 'home'
		);

		$this->load_view($data);
	}
}
