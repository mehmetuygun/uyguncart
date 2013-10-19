<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_model');
	}

	public function index()
	{
		$this->load->helper('url');
		redirect('/admin/user/account', 'location', 301);
	}

	public function account()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data = array(
			'title' => 'Account',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/user' => 'User',
				'last' => 'Account'
			),
			'mainview' => 'account'
		);

		$userID = $this->session->userdata('userID');
		$this->User_model->set($userID);

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$update = array();
			$fields = array(
				'email' => array(
					'col'   => 'email',
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|max_length[75]|is_unique[user.email]',
				),
				'fname' => array(
					'col'   => 'first_name',
					'field' => 'fname',
					'label' => 'First Name',
					'rules' => 'required|max_length[45]',
				),
				'lname' => array(
					'col'   => 'last_name',
					'field' => 'lname',
					'label' => 'Last Name',
					'rules' => 'required|max_length[45]',
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
					'pwd',
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
					$this->session->set_userdata('userFullName',
						$this->User_model->first_name . ' ' .
						$this->User_model->last_name
					);
				} else {
					$data['alert_message'] = 'Something went wrong.';
					$data['alert_class'] = 'alert-error';
				}
			}
		}

		$data['userEmail'] = $this->User_model->email;
		$data['userFirstName'] = $this->User_model->first_name;
		$data['userLastName'] = $this->User_model->last_name;

		$this->load_view($data);
	}

	public function password()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data = array(
			'title' => 'Password',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/user' => 'User',
				'last' => 'Password'
			),
			'mainview' => 'password'
		);

		$rules = array(
			array(
				'field' => 'current_password',
				'label' => 'Current Password',
				'rules' => 'required|min_length[8]|max_length[64]|checkpassword'
			),
			array(
				'field' => 'new_password',
				'label' => 'New Password',
				'rules' => 'required|min_length[8]|max_length[64]'
			),
			array(
				'field' => 'confirm_password',
				'label' => 'Confirm Password',
				'rules' => 'required|matches[new_password]'
			)
		);
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == true) {
			$update = array(
				'password' => $this->input->post('new_password'),
			);
			if ($this->User_model->update($update, $this->session->userdata('userID'))) {
				$data['alert_message'] = 'Your data is update succesfuly.';
				$data['alert_class'] = 'alert-success';
			} else {
				$data['alert_message'] = 'Something went wrong.';
				$data['alert_class'] = 'alert-error';
			}
		}

		$this->load_view($data);
	}
}
