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

	public function fetch($query = '', $order_by = 'random', $limit = 10, $page = 1)
	{
		$this->load->database();

		$this->db->from('product')
			->like('productName', $query)
			->order_by('productName', $order_by);
		 
		$this->entries = $this->db->count_all_results();
		$this->pagecount = ceil($this->entries / $limit);

		if($page == 1 or $page < 1) {
			$from = 0;
		} else if ($this->pagecount < $page) {
			$from = ($this->pagecount * $limit) - $limit;
		} else {
			$from = ($page * $limit) - $limit;
		}

		$this->db->from('product')
			->like('productName', $query)
			->order_by('productName', $order_by)
			->limit($limit, $from);

		$query = $this->db->get();

		$field = array();
		foreach ($query->result_array() as $res) {
			$field[] = $res;
		}
		return $field;
	}
}
