<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$this->load->library('session');
		$this->load->helper('url');

		$data['title'] = 'Login - UygunCart';

		if ($this->input->post()) {
			// loading user model
			$this->load->model('User_model');

			// check user data
			$login = $this->User_model->login(
				$this->input->post('email'),
				$this->input->post('password')
			);

			if ($login) {
				// setting user session information
				$session = array(
					'userID' => $this->User_model->user_id,
					'userEmail' => $this->User_model->email,
					'userFirstName' => $this->User_model->first_name,
					'userLastName' => $this->User_model->last_name,
					'userFullName' => $this->User_model->first_name .
						' ' . $this->User_model->last_name,
					'role' => $this->User_model->type,
					'logged_in' => true
				);
				$this->session->set_userdata($session);
			} else {
				$data['message'] = 'Invalid Email or Password.';
				$data['alert_class'] = 'alert-error';
			}
		}

		if ($this->session->userdata('logged_in')) {
			redirect('/admin/home');
		}
		$this->load->view('admin/login', $data);
	}
}
