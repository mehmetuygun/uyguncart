<?php

class Product_model extends CI_model
{

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
}
