<?php

class OrderItem_model extends MY_Model
{
	public $item_id;
	public $product_id;
	public $order_id;
	public $name;
	public $quantity;
	public $unit_price;


	public function __construct()
	{
		parent::__construct();

		parent::initialize('order_item', 'item_id');
	}
}
