<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
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

	/**
	 * @param	string	The form element to be checked
	 * @return	string
	 */
	public function alpha_int($str)
	{
		$str = (strtolower($this->CI->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;
		$this->CI->form_validation->set_message('alpha_int', 'The %s field may only contain alphabetical characters.');

		return !!preg_match("/^[[:alpha:]- ÀÁÂÃÄÅĀĄĂÆÇĆČĈĊĎĐÈÉÊËĒĘĚĔĖĜĞĠĢĤĦÌÍÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓÔÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚÛÜŪŮŰŬŨŲŴÝŶŸŹŽŻàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿœšß_.]+$/", $str);
	} 

	/**
	* @param string The form element to be checked
	* @return bolean
	*/ 
	public function category_exist($str)
	{
		return true;
		$this->CI->load->model('Category_model');
		$this->CI->form_validation->set_message('category_exist', 'The %s is exist.');
		// return $this->CI->Category_model->category_exist($str);
		// return false;
		return true;
	}
}
