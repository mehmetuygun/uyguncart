<?php
class User_model extends CI_model{

	public function login($email,$password){
		$this->load->database();

		$this->db->from('user');

		$data = array("userEmail"=>$email,"userPassword"=>$password);

		$this->db->where($data);

		if($this->db->count_all_results()==1)
			return true;
		else 
			return false;
	}
}
?>