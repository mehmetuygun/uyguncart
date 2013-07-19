<?php
class Setting_model extends CI_model{

	public $userEmail;
	public $userFirstName;
	public $userLastName;

	public function set($id){
		$this->load->database();

		$this->db->from('user');

		$data = array("userID"=>$id);

		$this->db->where($data);

		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$this->userEmail = $row->userEmail;
			$this->userFirstName = $row->userFirstName;
			$this->userLastName = $row->userLastName;
		}
	}

	public function update_account($field,$id){
		$this->load->database();
		return $this->db->update('user',$field,array('userID'=>$id));
	}
}
?>