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
		$data["fullname"] = $this->session->userdata('userFirstName').' '.$this->session->userdata('userLastName');
		$data["mainview"] = "account";

		$data["js"] = array("public/js/ajax.js");
		
		$this->Setting_model->set($this->session->userdata('userID'));

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{

			$field = array();
			if($this->input->post('email')!=$this->Setting_model->userEmail){
				$this->form_validation->set_rules('email','Email','required|valid_email|max_length[75]|is_unique[user.userEmail]');
				$field[] = array('userEmail'=>$this->input->post('email'));
			}
			else if($this->input->post('fname')!=$this->Setting_model->userFirstName){
				$this->form_validation->set_rules('fname','First Name','required|min_length[3]|max_length[45]|alpha');
				$field[] = array('userFirstName'=>$this->input->post('fname'));
			}
			else if($this->input->post('lname')!=$this->Setting_model->userLastName){
				$this->form_validation->set_rules('lname','Last Name','required|min_length[3]|max_length[45]|alpha');
				$field[] = array('userLastName'=>$this->input->post('userLastName'));
			}
			else{
				$data["alert_message"] = "No data entered.";
				$data["alert_class"] = "alert-error";
			}

			$field = array_shift($field);
			if(!is_null($field))
			{
				$this->form_validation->set_rules('pwd','Password','required|min_length[3]|max_length[45]|checkpassword');
			}

			$this->form_validation->set_error_delimiters('', '');

			if($this->form_validation->run() == TRUE)
			{	
				if($this->Setting_model->update_account($field,$this->session->userdata('userID')))
				{
					$data["alert_message"] = "Your data is update succesfuly.";
					$data["alert_class"] = "alert-success";
					$this->Setting_model->set($this->session->userdata('userID'));
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

		$this->load->view('admin/default',$data);

		$this->User_model->admin_logged();
	}
}