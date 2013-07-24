<?php

class User_model extends CI_model
{
	public $userID;
	public $userEmail;
	public $userFirstName;
	public $userLastName;
	public $userType;

	/**
	 *	User Authentication	
	 *
	 *	@param string The email of user
	 *	@param string The password of user
	 *	@return bool 
	 */
	public function login($email, $password)
	{
		$this->load->database();
		$this->db->from('user');

		$data = array('userEmail' => $email, 'userPassword' => $password);

		$this->db->where($data);
		$query = $this->db->get();
		
		if ($query->num_rows() != 1) {
			return false;
		}

		foreach($query->result() as $row){		
			$this->userID = $row->userID;
			$this->userEmail = $row->userEmail;
			$this->userFirstName = $row->userFirstName;
			$this->userLastName = $row->userLastName;
			$this->userType = $row->userType;
		}

		return true;
	}

	/**
	 *	Checking user is logged
	 *	
	 *	@return boole
	 */
	public function admin_logged()
	{
		$this->load->library('session');
		$this->load->helper('url');
		$check = $this->session->userdata('logged_in');

		if (!$check) {
			redirect('/admin/login', 'location');
		}
	}

	/**
	 *	Checking user's password is correct
	 *
	 *	@param string The password of user.
	 *	@param string The userID of user.
	 *	@return bool
	 */
	public function checkpassword($password, $id)
	{
		$this->load->database();
		$this->db->from('user');

		$data = array('userID' => $id, 'userPassword' => $password);

		$this->db->where($data);
		$query = $this->db->get();
		
		if ($query->num_rows() != 1) {
			return false;
		}

		return true;
	}
}
