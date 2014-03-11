<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends Main_Controller
{
	public function index()
	{
		$this->load->model('Order_model');

		$userID = $this->session->userdata('userID');

		$data = array(
			'title' => 'Orders',
			'mainview' => 'orders',
		);

		$orders = $this->Order_model->fetch(array(
			'filter' => array('user_id' => $userID),
		));

		$data['orders'] = $orders;

		$this->load_view($data);
	}
}
