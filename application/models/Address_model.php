<?php

class Address_model extends MY_Model
{
	
	public function __construct()
	{
		parent::__construct();
		parent::initialize('address', 'id');
	}

	public function fetch(array $params = array())
	{
		$this->order_by = 'address.id';
		$this->search_field = 'user_id';
		$this->search_term = '3';
		$this->filter = array('user_id' => 3);
		$this->join = array('country', 'address.id = country_id', 'left');
		return parent::fetch($params);
	}
}
