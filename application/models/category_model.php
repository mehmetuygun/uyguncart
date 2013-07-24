<?php

class Category_model extends CI_model
{
	public $categoryName;
	public $parentID;
	public $categoryID;
	public $entries;
	public $pagecount;

	/**
	 *	Setting category
	 *	@param string The ID of the category.
	 */
	public function set($id)
	{
		$this->load->database();
		$this->db->from('category')
			->where(array('categoryID' => $id));

		$row = $this->db->get()->result();
		$this->categoryID = $row->categoryID;
		$this->categoryName = $row->categoryName;
		$this->parentID = $row->parentID;
	}

	/**
	 *	Add category
	 *	
	 *	@param array The array include information to be updated. 
	 * 	@return boolean
	 */
	public function add($field) {
		$this->load->database();
		return $this->db->insert('category', $field);
	}

	/**
	 *	Edit category
	 *	
	 *	@param array The array include information to be updated. 
	 *	@param array The ID of the category to be updated. 
	 * 	@return boolean
	 */
	public function edit($field, $id)
	{
		$this->load->database();
		$data = array('categoryID' => $id);
		return $this->db->update('category', $field, $data);
	}

	/**
	 *	Delete category
	 *
	 *	@param array The array include information to be deleted.
	 *	@return boolean true for success
	 */
	public function delete($categoryID)
	{
		$this->load->database();
		$this->db->from('category')->where('parentID', $categoryID);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$this->delete($row->categoryID);
		}

		$data = array('categoryID' => $categoryID);

		return $this->db->delete('category', $data);
	}

	/**
	 *	Check if category is exist.
	 *
	 *	@param string The id of category.
	 *	@return boolean true for success
	 */
	public function category_exist($categoryID)
	{
		$this->load->database();
		$this->db->from('category')->where('categoryID', $categoryID);
		if($this->db->count_all_results()>0)
			return true;
		return false;
	}

	/**
	 *	Get category path.
	 *
	 *	@param	integer	Category ID.
	 *	@param	string	used for recursion
	 *	@return	string	path of the category
	 */
	public function get_path($id, $sep = '')
	{
		if (empty($id)) return '';

		$this->load->database();
		$this->db->from('category')->where('categoryID', $id);

		$query = $this->db->get();
		$row = $query->result_array();
		if (empty($row)) return '';

		return $this->get_path($row[0]['parentID'], ' / ')
			. $row[0]['categoryName'] . $sep;
	}

	/**
	 *	Get list of categories as an array.
	 *
	 *	@param	bool	add '-- NONE --' option
	 *	@return	array	list of categories
	 */
	public function fetchAll($with_none = false, $skip = false)
	{
		$this->load->database();
		$this->db->from('category');
		$query = $this->db->get();
		$field = array();

		if ($with_none) $field[''] = '-- NONE --';
		foreach ($query->result() as $row) {
			if ($row->categoryID === $skip) continue;
		 	$field[$row->categoryID] = $this->get_path($row->categoryID);
		}
		return $field;
	}

	/**
	 *	Get list of categories as an array page by page.
	 *
	 *	@param	bool	
	 *	@return	array	list of categories
	 */
	public function fetch($query = '', $sort = 'asc', $limit = 10, $page = 1)
	{
		$this->load->database();

		$this->db->from('category')
			->like('categoryName', $query)
			->order_by('categoryName', $sort);
		 
		$this->entries = $this->db->count_all_results();
		$this->pagecount = ceil($this->entries / $limit);

		if ($page == 1 or $page < 1) {
			$from = 0;
		} else if ($this->pagecount < $page) {
			$from = ($this->pagecount * $limit) - $limit;
		} else {
			$from = ($page * $limit) - $limit;
		}

		$this->db->from('category')
			->like('categoryName', $query)
			->order_by('categoryName', $sort)
			->limit($limit, $from);

		$query = $this->db->get();
		$field = array();
		foreach ($query->result() as  $row) {
			$field[] = array(
				'categoryID' => $row->categoryID,
				'categoryName' => $this->get_path($row->categoryID),
				'parentID' => $row->parentID
			);
		}
		return $field;
	}

	/**
	 * Groups categories by their parent ID
	 *
	 * @return array category IDs grouped by their parent ID
	 */
	public function group_by_parent()
	{
		$categories = array();
		$this->load->database();
		$this->db->from('category');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$categories[$row['parentID']][] = $row['categoryID'];
		}

		return $categories;
	}
}
