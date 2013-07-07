<?php
class User_model extends CI_model{

	public $userEmail;
	public $userName;
	public $userType;

	public function login($email,$password){
		$this->load->database();

		$this->db->from('user');

		$data = array("userEmail"=>$email,"userPassword"=>$password);

		$this->db->where($data);
		$query = $this->db->get();
		if($query->num_rows()==1){
			
			foreach ($query->result() as $row) {
				$this->userEmail = $row->userEmail;
				$this->userName = $row->userFirstName.' '.$row->userLastName;
				$this->userType = $row->userType;
			}
			return true;
		}
		else 
			return false;
	}
	// check the admin is logged
	public function admin_logged(){
		$this->load->library('session');
		$this->load->helper('url');
		$check = $this->session->userdata('logged_in');
		if(!$check)
			redirect('/admin/login', 'location', 301);
	}
}
?>