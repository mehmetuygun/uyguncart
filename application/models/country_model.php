<?php

class Country_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		parent::initialize('country', 'id');
	}

	public function insert(array $params = array())
	{
		return parent::insert($params);
	}

	public function fetch(array $params = array())
	{
		return parent::fetch($params);
	}

	public function fetchAll()
	{
		return parent::fetchAll();
	}

	public function get_countries()
	{
		$array = array();
		foreach ($this->fetchAll() as $row) {
			$array[$row['country_id']] = $row['name'];
		}
		return $array;
	}

}
