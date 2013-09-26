<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Setting_model');
	}

	public function index()
	{
		$this->load->helper('url');
		redirect('/admin/setting/account', 'location', 301);
	}

	public function account()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data = array(
			'title' => 'Account',
			'breadcrumb' => array(
				'admin/home' => 'Dashboard',
				'admin/setting' => 'Setting',
				'last' => 'Account'
			),
			'mainview' => 'account'
		);

		$userID = $this->session->userdata('userID');
		$this->Setting_model->set($userID);

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$update = array();
			$fields = array(
				'email' => array(
					'col'   => 'userEmail',
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|max_length[75]|is_unique[user.userEmail]',
				),
				'fname' => array(
					'col'   => 'userFirstName',
					'field' => 'fname',
					'label' => 'First Name',
					'rules' => 'required|max_length[45]',
				),
				'lname' => array(
					'col'   => 'userLastName',
					'field' => 'lname',
					'label' => 'Last Name',
					'rules' => 'required|max_length[45]',
				),
			);

			foreach ($fields as $f_name => $field) {
				if ($this->input->post($f_name) != $this->Setting_model->{$field['field']}) {
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
				if ($this->Setting_model->update($update, $userID)) {
					$data['alert_message'] = 'Your data has been updated successfully.';
					$data['alert_class'] = 'alert-success';
					$this->Setting_model->set($userID);
					$this->session->set_userdata($update);
					$this->session->set_userdata('userFullName',
						$this->Setting_model->userFirstName . ' ' .
						$this->Setting_model->userLastName
					);
				} else {
					$data['alert_message'] = 'Something went wrong.';
					$data['alert_class'] = 'alert-error';
				}
			}
		}

		$data['userEmail'] = $this->Setting_model->userEmail;
		$data['userFirstName'] = $this->Setting_model->userFirstName;
		$data['userLastName'] = $this->Setting_model->userLastName;

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
				'admin/setting' => 'Setting',
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
				'userPassword' => $this->input->post('new_password'),
			);
			if ($this->Setting_model->update($update, $this->session->userdata('userID'))) {
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
