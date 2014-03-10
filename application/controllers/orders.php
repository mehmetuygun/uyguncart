<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends Main_Controller
{
	/**
	 * Get list of orders as JSON
	 *
	 * @return void
	 */
	function get_list()
	{
		$this->load->model('Order_model');

		$userID = $this->session->userdata('userID');
		if (!$userID) {
			return $this->output_json(array());
		}

		$orders = $this->Order_model->fetch(array(
			'filter' => array('user_id' => $userID),
		));

		$this->output_json($orders);
	}
}
