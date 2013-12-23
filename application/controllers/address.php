<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends Main_Controller
{
	public function index()
	{
		$this->redirect_user('user/login');

		$data = array(
			'mainview' => 'addresses',
			'title' => 'Addresses',
			'js' => array('address.js'),
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

		$response = array('success' => false);
		$is_post = $this->input->server('REQUEST_METHOD') === 'POST';

		$this->load->library('form_validation');
		$this->load->model('Address_model');
		$userID = $this->session->userdata('userID');

		if ($id) {
			// Validate address id
			$addresses = $this->Address_model->fetch(array(
				'filter' => array(
					'user_id' => $userID,
					'address_id' => $id,
				),
				// Do not join with country table
				'join' => array(),
			));

			if (isset($addresses[0])) {
				$address = $addresses[0];
			} elseif ($is_post) {
				return $this->output_json($response);
			}
		}

		// Return modal HTML
		if (!$is_post) {
			$this->load->model('Country_model');
			$data = array(
				'countries' => $this->Country_model->get_countries(),
				'address_id' => '0',
			);

			if (isset($address)) {
				$data['address_id'] = $address['address_id'];
				$data['address'] = $address;
			}

			return $this->load->view('address_edit', $data);
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
				// Set the user_id for the address
				$field_list['user_id'] = $userID;
				$result = $this->Address_model->insert($field_list);
				if ($result > 0) {
					$response['success'] = true;
					$response['key'] = $result;
				}
			}
		}

		$this->output_json($response);
	}

	public function delete($id)
	{
		$response = array('success' => false);

		$this->load->model('Address_model');
		$userID = $this->session->userdata('userID');

		// Validate address id
		$addresses = $this->Address_model->fetch(array(
			'filter' => array(
				'user_id' => $userID,
				'address_id' => $id,
			),
			// Do not join with country table
			'join' => array(),
		));

		if (!isset($addresses[0])) {
			return $this->output_json($response);
		}

		$response['success'] = $this->Address_model->delete($id);
		$this->output_json($response);
	}
}
