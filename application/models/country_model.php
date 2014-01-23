<?php

class Country_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		parent::initialize('country', 'country_id');
	}

	/**
	 * Get list of countries with their ids
	 *
	 * @param  boolean $with_none True to add 'Please select' as first element
	 *
	 * @return array              List of countries
	 */
	public function get_countries($with_none = false)
	{
		$array = array();
		if ($with_none) {
			$array[''] = 'Please select';
		}

		foreach ($this->fetchAll() as $row) {
			$array[$row['country_id']] = $row['name'];
		}
		return $array;
	}

}
