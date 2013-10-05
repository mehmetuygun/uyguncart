<?php

class Category_model extends MY_Model
{
	public $category_id;
	public $name;
	public $parent_id;
	public $entries;
	public $pagecount;


	public function __construct()
	{
		parent::__construct();
		parent::initialize('category', 'category_id');
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
		$this->db->from('category')
			->where('parent_id', $categoryID);

		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$this->delete($row->categoryID);
		}

		$data = array('category_id' => $categoryID);

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
		$this->db->from('category')
			->where('category_id', $categoryID);

		return $this->db->count_all_results() > 0;
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
		$this->db->from('category')
			->where('category_id', $id);

		$row = $this->db->get()->row();
		if (empty($row)) return '';

		return $this->get_path($row->parent_id, ' / ')
			. $row->name . $sep;
	}

	/**
	 * Groups categories by their parent ID
	 *
	 * @return array category IDs grouped by their parent ID
	 */
	public function group_by_parent($full_row = false)
	{
		$categories = array();
		$this->load->database();
		$this->db->from('category');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$parent_list = &$categories[$row['parent_id']];
			$parent_list[] = $full_row ? $row : $row['category_id'];
		}

		return $categories;
	}

	/**
	 *	Fetch categories as array
	 *
	 *	@param array The array which includes param name and its value.
	 *	@return array
	 */
	public function fetch(array $params = array())
	{
		$this->order_by = 'name';
		$this->search_field = 'name';

		return parent::fetch($params);
	}

	/**
	 *	Get list of categories as an array.
	 *
	 *	@param	bool	add '-- NONE --' option
	 *	@param  integer	ID of the category to skip
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
			if ($row->category_id === $skip) continue;
		 	$field[$row->category_id] = $this->get_path($row->category_id);
		}
		return $field;
	}
}
