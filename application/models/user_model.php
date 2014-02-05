<?php

class User_model extends MY_Model
{
	public $user_id;
	public $email;
	public $first_name;
	public $last_name;
	public $type;

	public function __construct()
	{
		parent::__construct();
		parent::initialize('user', 'user_id');
	}
	
	/**
	 *	User Authentication
	 *
	 *	@param string The email of user
	 *	@param string The password of user
	 *	@return bool
	 */
	public function login($email, $password, $userType = null)
	{
		$this->load->database();

		$this->db->from('user')
			->where('email', $email)
			->where('password', $password);
		if($userType == 2)
			$this->db->where('type', $userType);
		$query = $this->db->get();

		if ($query->num_rows() != 1) {
			return false;
		}

		$row = $query->row();
		$this->user_id = $row->user_id;
		$this->email = $row->email;
		$this->first_name = $row->first_name;
		$this->last_name = $row->last_name;
		$this->type = $row->type;

		return true;
	}

	/**
	 *	Checking user is logged
	 *
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

		$data = array('user_id' => $id, 'password' => $password);

		$query = $this->db->where($data)->get();

		if ($query->num_rows() != 1) {
			return false;
		}

		return true;
	}
}
