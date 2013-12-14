<?php

class Address_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		parent::initialize('address', 'address_id');
	}

	public function insert(array $params = array())
	{
		$params['added_date'] = date('Y-m-d H:i:s');
		return parent::insert($params);
	}

	public function delete($id)
	{
		if ($this->is_used($id)) {
			return $this->soft_delete($id);
		}

		return parent::delete($id);
	}

	public function soft_delete($id)
	{
		$params['status'] = 0;
		return parent::update($params, $id);
	}

	public function is_used($address_id)
	{
		$this->load->database();
		$this->db->from('order')
			->where('shipping_address', $address_id)
			->or_where('billing_address', $address_id);

		return $this->db->count_all_results() > 0;
	}

	public function fetch(array $params = array())
	{
		$this->join = array('country', 'address.country_id = country.country_id', 'left');
		return parent::fetch($params);
	}
}
