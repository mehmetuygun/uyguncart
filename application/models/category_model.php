<?php

class Manufacturer_model extends CI_model
{
	public $categoryName;
	public $parentID;
	public $categoryID;

	/**
	 *	Setting category
	 *	@param string The ID of the category.
	 */
	public function set($id) {
		$this->load->database();
		$this->db->from('category')->where(array('categoryID' => $id));
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$this->categoryID = $row->categoryID;
			$this->categoryName = $row->categoryName;
			$this->parentID = $row->parentID;
		}
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
	 *	Delete category
	 *
	 *	@param array The array include information to be deleted.
	 *	@return boolean true for success
	 */
	public function delete($categoryID) {
		$this->load->database();
		return $this->db->delete('category', array('categoryID'=>$categoryID));
	}

}
