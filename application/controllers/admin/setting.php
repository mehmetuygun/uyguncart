<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		redirect('/admin/setting/account', 'location', 301);
	}
	public function account()
	{
		$this->load->model('User_model');
		$this->load->model('Setting_model');
		$this->load->library('session');
		$this->load->library('form_validation');

		$data["base_url"] = $this->load->helper(array('form', 'url'));
		$data["title"] = "UygunCart";
		$data["breadcrumb"] = array("admin/home"=>"Dashboard","admin/setting"=>"Setting","last"=>"Account");
		
		$data["mainview"] = "account";

		$data["js"] = array("public/js/ajax.js");
		
		$this->Setting_model->set($this->session->userdata('userID'));

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$field = array();
			if($this->input->post('email')!=$this->Setting_model->userEmail){
				$this->form_validation->set_rules('email','Email','required|valid_email|max_length[75]|is_unique[user.userEmail]');
				$field['userEmail'] = $this->input->post('email');
			}
			if($this->input->post('fname')!=$this->Setting_model->userFirstName){
				$this->form_validation->set_rules('fname','First Name','required|min_length[3]|max_length[45]|alpha_int');
				$field['userFirstName'] = $this->input->post('fname');
			}
			if($this->input->post('lname')!=$this->Setting_model->userLastName){
				$this->form_validation->set_rules('lname','Last Name','required|min_length[3]|max_length[45]|alpha_int');
				$field['userLastName'] = $this->input->post('lname');
			}

			if (is_null($field)) {
				$data["alert_message"] = "Enter data you want to update.";
				$data["alert_class"] = "alert-error";
			}
			else
			{
				$this->form_validation->set_rules('pwd','Password','required|min_length[8]|max_length[64]|checkpassword');
			}

			$this->form_validation->set_error_delimiters('', '');

			if($this->form_validation->run() == TRUE)
			{	
				if ($this->Setting_model->update_account($field, $this->session->userdata('userID')))
				{
					$data["alert_message"] = "Your data is update succesfuly.";
					$data["alert_class"] = "alert-success";
					$this->Setting_model->set($this->session->userdata('userID'));
					$this->session->set_userdata($field);
				}
				else
				{
					$data["alert_message"] = "Something went wrong.";
					$data["alert_class"] = "alert-error";	
				}
			}
		}

		$data["userEmail"] = $this->Setting_model->userEmail;
		$data["userFirstName"] = $this->Setting_model->userFirstName;
		$data["userLastName"] = $this->Setting_model->userLastName;

		$data["fullname"] = $this->session->userdata('userFullName');
		$this->load->view('admin/default',$data);

		$this->User_model->admin_logged();
	}

	public function password(){
		$this->load->model('User_model');
		$this->load->model('Setting_model');
		$this->load->library('session');
		$this->load->library('form_validation');

		$data["base_url"] = $this->load->helper(array('form', 'url'));
		$data["title"] = "UygunCart";
		$data["breadcrumb"] = array("admin/home"=>"Dashboard","admin/setting"=>"Setting","last"=>"Password");
		$data["fullname"] = $this->session->userdata('userFullName');
		$data["mainview"] = "password";

		$this->form_validation->set_rules('current_password','Current Password','required|min_length[8]|max_length[64]|checkpassword');
		$this->form_validation->set_rules('new_password','New Password','required|min_length[8]|max_length[64]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|min_length[8]|max_length[64]|matches[new_password]');
		$this->form_validation->set_error_delimiters('', '');
		
		if($this->form_validation->run() == TRUE)
		{
			if($this->Setting_model->update_account(array('userPassword'=>$this->input->post('new_password')),$this->session->userdata('userID')))
			{
				$data["alert_message"] = "Your data is update succesfuly.";
				$data["alert_class"] = "alert-success";
			}
			else
			{
				$data["alert_message"] = "Something went wrong.";
				$data["alert_class"] = "alert-error";		
			}
		}

		$this->load->view('admin/default',$data);
	}
}