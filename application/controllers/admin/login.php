<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{

	public function index()
	{	
		$this->load->library('session');
		$data["base_url"] = $this->load->helper('url');
		$data["title"] = "UygunCart Administator";

		if($this->session->userdata('logged_in'))
			redirect('/admin/home');
		
		if($this->input->post()){
			$data["alert"] = "true";

			// loading user model
			$this->load->model('User_model');

			// check user data
			if($this->User_model->login($this->input->post('email'), $this->input->post('password'))) {
				$data["message"] = "logged";
				$data["alert_class"] = "alert-success";

				// setting user session information
				$session = array(
					'userID' => $this->User_model->userID,
					'userEmail' => $this->User_model->userEmail,
					'userFirstName' => $this->User_model->userFirstName,
					'userLastName' => $this->User_model->userLastName,
					'userFullName' => $this->User_model->userFirstName. ' ' .$this->User_model->userLastName,
					'role' => $this->User_model->userType,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($session);

				redirect('/admin/home', 'location');
			} else {
				$data["message"] = 'Invalid Email or Password.';
				$data["alert_class"] = "alert-error";
			}
		}
		$this->load->view('admin/login.php', $data);
	}
}