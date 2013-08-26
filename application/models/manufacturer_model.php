<?php

class Manufacturer_model extends MY_Model
{
	public $manufacturerID;
	public $manufacturerName;
	public $entries;
	public $pagecount;


	public function __construct()
	{
		parent::__construct();
		parent::initialize('manufacturer', 'manufacturerID');
	}

	/**
	 *	Fetch manufacturers as array
	 *
	 *	@param array The array which includes param name and its value.
	 *	@return array
	 */
	public function fetch(array $params = array())
	{
		$this->order_by = 'manufacturerName';
		$this->search_field = 'manufacturerName';

		return parent::fetch($params);
	}

	public function fetchAll($with_none = false)
	{
		$this->load->database();
		$this->db->from('manufacturer');
		$query = $this->db->get();
		$field = array();
		if ($with_none) $field[''] = '-- NONE --';
		foreach ($query->result() as $row) {
		 	$field[$row->manufacturerID] = $row->manufacturerName;
		}
		return $field;
	}
}
