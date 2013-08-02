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
}
