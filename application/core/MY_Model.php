<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	public $pagecount;
	public $page = 1;
	public $entries;
	public $limit = 10;

	protected $table;
	protected $primary_key;

	protected $search_term = '';
	protected $order_by;
	protected $search_field;
	protected $filter = array();
	protected $join = array();
	protected $sort = 'asc';

	/**
	 * Set the table name and the primary key for the model
	 *
	 * @param  string $table       Table name
	 * @param  string $primary_key Primary key column name
	 *
	 * @return void
	 */
	public function initialize($table, $primary_key)
	{
		$this->table = $table;
		$this->primary_key = $primary_key;
	}

	/**
	 * Gets the row for the given id and returns the row as an object
	 *
	 * @param integer $id Value of the primary key
	 *
	 * @return object Row object
	 */
	public function set($id)
	{
		$this->load->database();
		$row = $this->db->from($this->table)
			->where($this->primary_key, $id)
			->get()->row();

		foreach ($row as $col => $field) {
			$this->$col = $field;
		}

		return $row;
	}

	/**
	 * Inserts a new row into the table and returns the id of the new row
	 *
	 * @param  array $fields Associative array of fields and their values
	 *
	 * @return integer       Id of the inserted row
	 */
	public function insert($fields)
	{
		$this->load->database();
		$this->db->insert($this->table, $fields);

		return $this->db->insert_id();
	}

	/**
	 * Updates a row
	 *
	 * @param  array   $fields Associative array of fields and their values
	 * @param  integer $id     Id of the row to be updated
	 *
	 * @return boolean         Whether the row update succeeded
	 */
	public function update($fields, $id)
	{
		$this->load->database();
		$data = array($this->primary_key => $id);

		return $this->db->update($this->table, $fields, $data);
	}

	/**
	 * Deletes a row
	 *
	 * @param  integer $id Id of the row to be deleted
	 *
	 * @return boolean     Whether the row delete succeeded
	 */
	public function delete($id)
	{
		$this->load->database();
		$data = array($this->primary_key => $id);

		return $this->db->delete($this->table, $data);
	}

	/**
	 * Fetch multiple rows with joins and filters
	 *
	 * @param  array  $params List of parameters
	 *
	 * @return array          Array of rows
	 */
	public function fetch(array $params = array())
	{
		$this->load->database();

		foreach ($params as $key => $value) {
			$this->$key = $value;
		}

		// Make sure filter parameter is array of arrays
		if (!is_array(reset($this->filter))) {
			$this->filter = array($this->filter);
		}

		// Make sure join parameter is array of arrays
		if (isset($this->join[0]) && !is_array($this->join[0])) {
			$this->join = array($this->join);
		}

		$this->db->from($this->table);
		// Do the like
		if ($this->search_field && $this->search_term) {
			$this->db->like($this->search_field, $this->search_term);
		}
		// Do the filters
		foreach ($this->filter as $filter) {
			call_user_func_array(array($this->db, 'where'), array($filter));
		}
		// Do the joins
		foreach ($this->join as $join) {
			call_user_func_array(array($this->db, 'join'), $join);
		}

		// Don't let query get discarded
		// when count_all_results is called
		$query = clone $this->db;

		// Count all results matching the search for pagination
		$this->entries = $this->db->count_all_results();
		$this->pagecount = ceil($this->entries / $this->limit);

		$this->db = $query;
		unset($query);

		// Return empty array if no result found
		if ($this->entries == 0) {
			return array();
		}

		// Check if the requested page exists
		if ($this->page > $this->pagecount) {
			$this->page = $this->pagecount;
		} else if ($this->page < 1) {
			$this->page = 1;
		}
		// Calculate query offset
		$start = ($this->page - 1) * $this->limit;

		// Do the order by
		if ($this->order_by && $this->sort) {
			$this->db->order_by($this->order_by, $this->sort);
		}
		// Do the limit
		$this->db->limit($this->limit, $start);

		// Get the result
		$result = $this->db->get();

		$rows = array();
		foreach ($result->result_array() as $row) {
			$rows[] = $row;
		}

		return $rows;
	}

	/**
	 * Fetch all rows from a table
	 *
	 * @return array Array containing all the rows
	 */
	public function fetchAll()
	{
		$this->load->database();
		$this->db->from($this->table);
		$result = $this->db->get();
		return $result->result_array();
	}
}
