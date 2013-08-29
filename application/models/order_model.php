<?php

class Order_model extends MY_Model
{
	public $id;
	public $user_id;
	public $payment_id;
	public $total_price;
	public $shipping_address;
	public $billing_address;
	public $date_created;
	public $date_modified;


	public function __construct()
	{
		parent::__construct();

		parent::initialize('order', 'id');
	}
}
