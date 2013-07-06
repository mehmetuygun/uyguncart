<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data["base_url"] = $this->load->helper('url');
		$data["title"] = "UygunCart Administator";
		if($this->input->post()){
			$data["alert"] = "true";

			// loading user model
			$this->load->model('User_model');

			// check user data
			if($this->User_model->login($this->input->post('email'),$this->input->post('password'))){
				$data["message"] = "logged";
				$data["alert_class"] = "alert-success";
				redirect('/admin/home', 'location', 301);
			}
			else {
				$data["message"] = "wrong information";
				$data["alert_class"] = "alert-error";
			}
				
			
		}
		$this->load->view('admin/login.php',$data);
	}
	public function sex(){
		echo "sex";
	}
}