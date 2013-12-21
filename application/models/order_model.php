<?php

class Order_model extends MY_Model
{
	public $order_id;
	public $user_id;
	public $payment_id;
	public $total_price;
	public $shipping_address;
	public $billing_address;
	public $added_date;
	public $updated_date;


	public function __construct()
	{
		parent::__construct();

		parent::initialize('order', 'order_id');
	}

	public function insert($row)
	{
		$row['added_date'] = date('Y-m-d H:i:s');

		return parent::insert($row);
	}
}
