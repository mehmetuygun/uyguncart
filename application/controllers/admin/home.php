<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Admin_Controller
{
	public function index()
	{
		$data = array(
			'title' => 'Home',
			'breadcrumb' => array(
				'last' => 'Dashboard'
			),
			'mainview' => 'home',
			'js' => array('home.js'),
		);

		$this->load_view($data);
	}
}
