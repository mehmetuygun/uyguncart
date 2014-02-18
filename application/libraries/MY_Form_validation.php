<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	public function __construct()
	{
		parent::__construct();

		$this->_error_prefix = '';
		$this->_error_suffix = '';
	}

	/**
	 * Get form validation errors as an array
	 *
	 * @return array Form validation errors by field name
	 */
	public function get_errors()
	{
		$error_list = array();

		foreach ($this->_field_data as $data) {
			if (!$data['error']) {
				continue;
			}

			$error_list[] = array(
				'field' => $data['field'],
				'error' => $data['error'],
			);
		}
		
		return $error_list;
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

	/*
	 * @param	integer	Category to look for in the list of children
	 * @param	integer	Category to check the children of
	 * @param	array	List of categories, used for recursion
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

	/**
	 * @param  string the value to look for in the table
	 * @param  string table name and field name separated by a dot
	 * @return bool   valid
	 */
	public function exists($str, $field)
	{
		$this->CI->form_validation->set_message('exists', 'The %s does not exist.');
		list($table, $field) = explode('.', $field);
		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));

		return $query->num_rows() != 0;
	}

	/**
	 * @param  string the value to look for in the table
	 * @param  string table name and field name separated by a dot
	 * @return bool   valid
	 */
	public function exists_null($str, $field)
	{
		if ($str == null) {
			return true;
		}

		$this->CI->form_validation->set_message('exists_null', 'The %s does not exist.');
		list($table, $field) = explode('.', $field);
		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));

		return $query->num_rows() != 0;
	}

	/**
	 * @param  string the value to check
	 * @return bool   valid
	 */
	public function status($str)
	{
		$this->CI->form_validation->set_message('status', 'The %s field contains invalid status.');

		return $str === '0' || $str === '1';
	}
}
