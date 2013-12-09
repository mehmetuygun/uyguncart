<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends Main_Controller
{
	public function index()
	{
		$this->redirect_user('user/login');

		$data = array(
			'mainview' => 'addresses',
			'title' => 'Addresses',
		);

		$userID = $this->session->userdata('userID');

		$this->load->model('Address_model');

		$data['addresses'] = $this->Address_model->fetch(array(
			'filter' => array('user_id' => $userID),
		));

		$this->load_view($data);
	}
}
