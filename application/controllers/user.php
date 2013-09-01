<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function register()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('User_model');
		$this->load->library('session');

		$data = array(
			'mainview' => 'register'
		);

		$rules = array(
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[8]|max_length[64]|matches[re-password]'
			),
			array(
				'field' => 're-password',
				'label' => 'Re-password',
				'rules' => 'required|min_length[8]|max_length[64]|matches[password]'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|max_length[64]|email|is_unique[user.userEmail]'
			),
			array(
				'field' => 'firstname',
				'label' => 'First Name',
				'rules' => 'required|min_length[3]|max_length[64]'
			),
			array(
				'field' => 'lastname',
				'label' => 'Last Name',
				'rules' => 'required|min_length[3]|max_length[64]'
			)
		);
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == true) {
			$data = array(
					'userEmail' => $this->input->post('email'),
					'userFirstName' => $this->input->post('firstname'),
					'userLastName' => $this->input->post('lastname'),
					'userPassword' => $this->input->post('password'),
					'userType' => 2
				);

			if($this->User_model->insert($data)) {
				$session = array(
					'userID' => $this->User_model->userID,
					'userFirstName' => $this->input->post('firstname'),
					'userLastName' => $this->input->post('lastname'),
					'userFullName' =>  $this->input->post('firstname').' '.$this->input->post('lastname'),
					'userLoggedIn' => true
					);
				$this->session->set_userdata($session);
				redirect(base_url());
			}
		}

		$this->load->view('body', $data);
	}

	public function login()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('User_model');
		$this->load->library('session');

		$data = array(
			'mainview' => 'login'
		);

		$rules = array(
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			),
		);
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == true) {
			if($this->User_model->login($this->input->post('email'), $this->input->post('password'), 2)) {
				$session = array(
					'userID' => $this->User_model->userID,
					'userFirstName' => $this->User_model->userFirstName,
					'userLastName' => $this->User_model->userLastName,
					'userFullName' =>  $this->User_model->userFirstName.' '.$this->User_model->userLastName,
					'userLoggedIn' => true
					);
				$this->session->set_userdata($session);
				redirect(base_url());
			}
		}
		$this->load->view('body', $data);	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */