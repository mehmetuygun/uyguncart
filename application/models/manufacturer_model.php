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
	 * Get list of manufacturer
	 *
	 * @param string search query.
	 * @param string order by asc, desc, or random.
	 * @param string limit of display.
	 * @param string page of number.
	 * @return array
	 */
	public function fetch($query = '', $order_by = 'random', $limit = 10, $page = 1)
	{
		$this->load->database();

		$this->db->from('manufacturer')
			->like('manufacturerName', $query)
			->order_by('manufacturerName', $order_by);

		$this->entries = $this->db->count_all_results();
		$this->pagecount = ceil($this->entries / $limit);

		if($page == 1 or $page < 1) {
			$from = 0;
		} else if ($this->pagecount < $page) {
			$from = ($this->pagecount * $limit) - $limit;
		} else {
			$from = ($page * $limit) - $limit;
		}

		$this->db->from('manufacturer')
			->like('manufacturerName', $query)
			->order_by('manufacturerName', $order_by)
			->limit($limit, $from);

		$query = $this->db->get();
		return $query->result();
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
