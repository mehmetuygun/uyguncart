<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	function __construct()
	{
		parent::__construct();

		$this->_error_prefix = '';
		$this->_error_suffix = '';
	}

	/**
	 * @param	string	The form element to be checked
	 * @return	bool	valid
	 */
	public function checkpassword($str)
	{
		$this->CI->load->model('User_model');
		$this->CI->load->library('session');
		$this->CI->form_validation->set_message('checkpassword', 'The %s field must be correct.');
		if ($this->CI->User_model->checkpassword($str, $this->CI->session->userdata('userID'))) {
			return true;
		}

		return false;
	}

	/**
	 * @param	string	The form element to be checked
	 * @return	bool	valid
	 */
	public function alpha_int($str)
	{
		$str = (strtolower($this->CI->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;
		$this->CI->form_validation->set_message('alpha_int', 'The %s field may only contain alphabetical characters.');

		return !!preg_match("/^[[:alpha:]- ÀÁÂÃÄÅĀĄĂÆÇĆČĈĊĎĐÈÉÊËĒĘĚĔĖĜĞĠĢĤĦÌÍÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓÔÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚÛÜŪŮŰŬŨŲŴÝŶŸŹŽŻàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿœšß_.]+$/", $str);
	}

	/**
	 * @param	string	The form element to be checked
	 * @return	bool	valid
	 */
	public function category_exist($str)
	{
		$this->CI->load->model('Category_model');
		$this->CI->form_validation->set_message('category_exist', 'The %s does not exist.');
		if ($str == null) {
			return true;
		}

		return $this->CI->Category_model->category_exist($str);
	}

	/*
	 * @param	integer	Category to look for in the list of children
	 * @param	integer	Category to check the children of
	 * @return	bool	valid
	 */
	public function not_sub_category($id, $target, $categories = null)
	{
		$this->CI->form_validation->set_message('not_sub_category', '%s is a subcategory of the current category.');
		if ($id == $target) return false;

		if (!isset($categories)) {
			$categories = $this->CI->Category_model->group_by_parent();
		}

		if (empty($categories[$target])) {
			return true;
		}

		foreach ($categories[$target] as $categoryID) {
			if (!$this->not_sub_category($id, $categoryID, $categories)) {
				return false;
			}
		}

		return true;
	}

	public function exists($str, $field)
	{
		$this->CI->form_validation->set_message('exists', 'The %s field does not exists.');
		list($table, $field) = explode('.', $field);
		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));

		return $query->num_rows() != 0;
	}

	public function exists_null($str, $field)
	{
		if ($str == null) {
			return true;
		}

		$this->CI->form_validation->set_message('exists', 'The %s field does not exists.');
		list($table, $field) = explode('.', $field);
		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));

		return $query->num_rows() != 0;
	}

	public function alpha_dash_space($str)
	{
		$this->CI->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alphabetical characters.');

		return !!preg_match("/^([-a-z_ ])+$/i", $str);
	}

	public function status($str)
	{
		$this->CI->form_validation->set_message('status', 'The %s field contains invalid status.');

		return $str === '0' || $str === '1';
	}
}
