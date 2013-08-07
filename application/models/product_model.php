<?php

class Product_model extends CI_model
{

	public $productID;
	public $productName;
	public $productPrice;
	public $productDescription;
	public $productStatus;
	public $categoryID;
	public $manufacturerID;

	public $search_term = '';
	public $pagecount;
	public $entries;
	public $limit = 10;
	public $page = 1;
	public $order_by = 'productName';
	public $sort = 'asc';

	public function add($field)
	{
		$this->load->database();
		return $this->db->insert('product', $field);
	}

	public function insert_id()
	{
		$this->load->database();
		return $this->db->insert_id();
	}

	public function set($id)
	{
		$this->load->database();
		$this->db->from('product')->where('productID',$id);

		$row = $this->db->get()->row();

		$this->productID = $row->productID;
		$this->productName = $row->productName;
		$this->productPrice = $row->productPrice;
		$this->productDescription = $row->productDescription;
		$this->productStatus = $row->productStatus;
		$this->categoryID = $row->categoryID;
		$this->manufacturerID = $row->manufacturerID;

		return $row;
	}
	/**
	 *	Update product
	 *
	 *	@param array The array include information to be updated.
	 *	@param integer ID of the product
	 *	@return boolean true for success
	 */
	public function update($field, $id)
	{
		$this->load->database();
		$data = array('productID' => $id);
		return $this->db->update('product', $field, $data);
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

		return $this->db->delete('product', $field);
	}

	/**
	 *	Fetch products as array
	 *
	 *	@param array The array which includes param name and its value.
	 *	@return array
	 */
	public function fetch(array $param)
	{
		foreach ($param as $key => $value)
			$this->$$key = $value;
		
		$this->load->database();

		$this->db->from('product')
			->like('productName', $this->search_term)
			->order_by($this->order_by, $this->sort);

		$this->entries = $this->db->count_all_results();
		$this->pagecount = ceil($this->entries / $this->limit);

		if($this->page == 1 or $this->page < 1) {
			$from = 0;
		} else if ($this->pagecount < $this->this->page) {
			$from = ($this->pagecount * $this->limit) - $this->limit;
		} else {
			$from = ($this->page * $this->limit) - $this->limit;
		}

		$this->db->from('product')
			->like('productName', $this->search_term)
			->order_by('productName', $order_by)
			->limit($this->limit, $from);

		$query = $this->db->get();

		$field = array();
		foreach ($query->result_array() as $res) {
			$field[] = $res;
		}
		return $field;
	}
}
