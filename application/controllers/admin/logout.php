<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller
{
	public function index() 
	{
		$this->load->library('session');
		$this->load->model('User_model');
		$this->load->helper('url');
		$this->session->sess_destroy();
		$this->User_model->admin_logged();
	}
}
