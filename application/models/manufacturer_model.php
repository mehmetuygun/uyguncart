<?php

class Manufacturer_model extends CI_Model
{
	public $manufacturerName;
	public $entries;
	public $pagecount;

	/**
	 *	Setting manufacturer
	 *	@param string The ID of the manufacturer.
	 */
	public function set($id)
	{
		$this->load->database();
		$this->db->from('manufacturer')
			->where(array('manufacturerID' => $id));

		$row = $this->db->get()->row();
		$this->manufacturerName = $row->manufacturerName;
	}

	/**
	 *	Create manufacturer information
	 *
	 *	@param array The array include information to be updated.
	 * 	@return boolean
	 */
	public function insert($field)
	{
		$this->load->database();
		return $this->db->insert('manufacturer', $field);
	}

	/**
	 *	Update manufacturer
	 *
	 *	@param array The array include information to be updated.
	 *	@param integer ID of the manufacturer
	 *	@return boolean true for success
	 */
	public function update($field, $id)
	{
		$this->load->database();
		$data = array('manufacturerID' => $id);
		return $this->db->update('manufacturer', $field, $data);
	}

	/**
	 *	Delete manufacturer
	 *
	 *	@param array The array include information to be deleted.
	 *	@return boolean true for success
	 */
	public function delete($field)
	{
		$this->load->database();

		return $this->db->delete('manufacturer', $field);
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

	public function fetchAll ($with_none = FALSE)
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
