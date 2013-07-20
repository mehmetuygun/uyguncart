<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class my_form_validation extends CI_Form_validation
{
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	* @param	string	The form element to be checked
	* @return	string
	*/	
	public function checkpassword($str)
	{
		$this->CI->load->model('User_model');
		$this->CI->load->library('session');
		$this->CI->form_validation->set_message('checkpassword', 'The %s field must be correct.');
		if($this->CI->User_model->checkpassword($str,$this->CI->session->userdata('userID')))
			return true;
		else 
			return false;
	}
}

?>