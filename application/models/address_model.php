<?php

class Address_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		parent::initialize('address', 'id');
	}

	public function insert(array $params = array())
	{
		$params['added_date'] = date('Y-m-d H:i:s');
		return parent::insert($params);
	}

	public function fetch(array $params = array())
	{
		$this->join = array('country', 'address.country_id = country.country_id', 'left');
		return parent::fetch($params);
	}

	public function get_countries()
	{
		$this->load->library('db');
	}
}
