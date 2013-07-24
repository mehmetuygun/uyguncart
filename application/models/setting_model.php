<?php

class Setting_model extends CI_model
{
	public $userEmail;
	public $userFirstName;
	public $userLastName;

	/**
	 *	Setting user information
	 *	@param string The userID of user.
	 */
	public function set($id)
	{
		$this->load->database();
		$this->db->from('user')
			->where(array('userID' => $id));

		$row = $this->db->get()->row();
		$this->userEmail = $row->userEmail;
		$this->userFirstName = $row->userFirstName;
		$this->userLastName = $row->userLastName;
	}

	/**
	 *	Update user's personal information
	 *	
	 *	@param array The array include information to be updated. 
	 *	@param string The userID of user.
	 * 	@return boolean
	 */
	public function update_account($field, $id)
	{
		$this->load->database();
		$data = array('userID' => $id);
		return $this->db->update('user', $field, $data);
	}
}
