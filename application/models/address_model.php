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
		$this->join = array('country', 'address.id = country_id', 'left');
		return parent::fetch($params);
	}

	public function get_countries()
	{
		$this->load->library('db');
	}
}
