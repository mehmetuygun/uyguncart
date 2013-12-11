<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends Main_Controller
{
	public function index()
	{
		$this->redirect_user('user/login');

		$data = array(
			'mainview' => 'addresses',
			'title' => 'Addresses',
		);

		$userID = $this->session->userdata('userID');

		$this->load->model('Address_model');

		$data['addresses'] = $this->Address_model->fetch(array(
			'filter' => array('user_id' => $userID),
		));

		$this->load_view($data);
	}

	public function edit($id)
	{
		$this->redirect_user('user/login');

		$this->load->library('form_validation');
		$this->load->model('Address_model');
		$userID = $this->session->userdata('userID');

		if ($id) {
			$addresses = $this->Address_model->fetch(array(
				'filter' => array(
					'user_id' => $userID,
					'address_id' => $id,
				),
				'join' => array(),
			));

			if (!isset($addresses[0])) {
				return false;
			}

			$address = $addresses[0];
		}

		$rules = array(
			array(
				'field'   => 'full_name',
				'label'   => 'Full Name',
				'rules'   => 'required|max_length[64]'
			),
			array(
				'field'   => 'city',
				'label'   => 'City',
				'rules'   => 'required|max_length[64]'
			),
			array(
				'field'   => 'address1',
				'label'   => 'Address 1',
				'rules'   => 'required|max_length[64]'
			),
			array(
				'field'   => 'address2',
				'label'   => 'Address 2',
				'rules'   => 'required|max_length[64]'
			),
			array(
				'field'   => 'postcode',
				'label'   => 'Postcode',
				'rules'   => 'required|max_length[24]'
			),
			array(
				'field'   => 'country_id',
				'label'   => 'Country',
				'rules'   => 'required|exists[country.country_id]'
			),
		);

		$this->form_validation->set_rules($rules);

		$field_list = array();

		$response = array('success' => false);
		if ($this->form_validation->run() === true) {
			foreach ($rules as $key => $field) {
				$new_value = $this->input->post($field['field']);
				// Add
				if (!$id) {
					$field_list[$field['field']] = $new_value;
					continue;
				}

				// Update
				$old_value = $address[$field['field']];
				if ($old_value != $new_value) {
					$field_list[$field['field']] = $new_value;
				}
			}

			if ($id) {
				$result = $this->Address_model->update($field_list, $id);
				if ($result) {
					$response['success'] = true;
				}
			} else {
				$result = $this->Address_model->insert($field_list);
				if ($result > 0) {
					$response['success'] = true;
					$response['key'] = $result;
				}
			}
		}

		$this->output_json($response);
	}
}
