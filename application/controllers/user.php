<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Main_Controller
{
	public function register()
	{
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model('User_model');

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

		$this->load_view($data);
	}

	public function login()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model('User_model');

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
		$this->load_view($data);
	}

	public function logout()
	{
		$this->load->helper('url');
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect(base_url());

	}

	public function account()
	{
		$data['mainview'] = 'account';

		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('User_model');
		$userID = $this->session->userdata('userID');
		$this->User_model->initialize('user', 'userID');
		$this->User_model->set($userID);

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$update = array();
			$fields = array(
				'email' => array(
					'col'   => 'userEmail',
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|max_length[75]|is_unique[user.userEmail]',
				),
				'firstname' => array(
					'col'   => 'userFirstName',
					'field' => 'firstname',
					'label' => 'First Name',
					'rules' => 'required|min_length[3]|max_length[45]|alpha_int',
				),
				'lastname' => array(
					'col'   => 'userLastName',
					'field' => 'lastname',
					'label' => 'Last Name',
					'rules' => 'required|min_length[3]|max_length[45]|alpha_int',
				),
			);

			foreach ($fields as $f_name => $field) {
				if ($this->input->post($f_name) != $this->User_model->{$field['col']}) {
					$this->form_validation->set_rules(array($field));
					$update[$field['col']] = $this->input->post($f_name);
				}
			}

			if (empty($update)) {
				$data['alert_message'] = 'Enter data you want to update.';
				$data['alert_class'] = 'alert-error';
			} else {
				$this->form_validation->set_rules(
					'password',
					'Password',
					'required|min_length[8]|max_length[64]|checkpassword'
				);
			}

			if ($this->form_validation->run() == true) {
				if ($this->User_model->update($update, $userID)) {
					$data['alert_message'] = 'Your data has been updated successfully.';
					$data['alert_class'] = 'alert-success';
					$this->User_model->set($userID);
					$this->session->set_userdata($update);
				} else {
					$data['alert_message'] = 'Something went wrong.';
					$data['alert_class'] = 'alert-error';
				}
			}
		}

		$this->User_model->set('userID', $userID);

		$data['userID'] = $this->User_model->userID;
		$data['userFirstName'] = $this->User_model->userFirstName;
		$data['userLastName'] = $this->User_model->userLastName;
		$data['userEmail'] = $this->User_model->userEmail;

		$this->load_view($data);
	}
}
