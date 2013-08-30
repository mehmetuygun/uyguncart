<?php

class Payment_model extends MY_Model
{
	public $id;
	public $user_id;
	public $order_id;
	public $gateway_ref;


	public function __construct()
	{
		parent::__construct();

		parent::initialize('payment', 'id');
	}
}
