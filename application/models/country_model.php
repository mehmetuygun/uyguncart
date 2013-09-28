<?php

class Country_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		parent::initialize('country', 'country_id');
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
