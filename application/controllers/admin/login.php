<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{	
		$this->load->library('session');
		$data["base_url"] = $this->load->helper('url');
		$data["title"] = "UygunCart Administator";
		if($this->input->post()){
			$data["alert"] = "true";

			// loading user model
			$this->load->model('User_model');

			// check user data
			if($this->User_model->login($this->input->post('emaisl'),$this->input->post('password'))){
				$data["message"] = "logged";
				$data["alert_class"] = "alert-success";

				// setting user session information
				$session = array(
					'userID'=>$this->User_model->userID,
					'userEmail'=>$this->User_model->userEmail,
					'userFirstName'=>$this->User_model->userFirstName,
					'userLastName'=>$this->User_model->userLastName,
					'role'=>$this->User_model->userType,
					'logged_in'=>TRUE
					);
				$this->session->set_userdata($session);

				redirect('/admin/home', 'location', 301);
			}
			else {
				$data["message"] = 'Email and password did not match.';
				$data["alert_class"] = "alert-error";
			}
				
			
		}
		$this->load->view('admin/login.php',$data);
	}
	public function test(){
		echo "test";
	}
}