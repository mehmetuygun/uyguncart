<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function Index(){
		$this->load->model('User_model');
		$this->User_model->admin_logged();
		$data["base_url"] = $this->load->helper('url');
		$data["title"] = "UygunCart";
		$this->load->view('admin/header.php',$data);
	}
}