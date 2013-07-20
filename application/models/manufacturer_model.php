<?php
class Manufacturer_model extends CI_model{

	public $manufacturerName;

	/**
	*	Setting manufacturer
	*	@param string The manufacturerID of manufacturer.
	*/
	public function set($id){
		$this->load->database();

		$this->db->from('manufacturer');

		$data = array("manufacturerID"=>$id);

		$this->db->where($data);

		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$this->manufacturerName = $row->manufacturerName;
		}
	}

	/**
	*	Update user's personal information
	*	
	*	@param array The array include information to be updated. 
	*	@param string The userID of user.
	* 	@return boolean
	*/
	public function insert ($field){
		$this->load->database();
		return $this->db->insert('manufacturer',$field);
	}
}
?>