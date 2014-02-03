<?php

class Address_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		parent::initialize('address', 'address_id');
	}

	/**
	 * Inserts a new address with added_date
	 *
	 * @param  array  $params Details of the address
	 *
	 * @return integer        ID of the created address
	 */
	public function insert(array $params = array())
	{
		$params['added_date'] = date('Y-m-d H:i:s');
		return parent::insert($params);
	}

	/**
	 * Deletes an address permanently or temporarly depending if it was used
	 *
	 * @param  integer $id ID of the address to be deleted
	 *
	 * @return bool        Whether the delete succeeded
	 */
	public function delete($id)
	{
		if ($this->is_used($id)) {
			return $this->soft_delete($id);
		}

		return parent::delete($id);
	}

	/**
	 * Creates a new address using the provided ID
	 *
	 * @param  integer $id ID of the address to be duplicated
	 *
	 * @return integer     Insert ID
	 */
	public function duplicate($id)
	{
		$this->load->database();
		$row = $this->db->from($this->table)
			->where($this->primary_key, $id)
			->get()
			->row_array();

		unset($row['updated_date']);

		return $this->insert($row);
	}

	/**
	 * Soft-deletes an address by setting status to 0
	 *
	 * @param  integer $id ID of the address to be soft-deleted
	 *
	 * @return bool        Whether the update succeeded
	 */
	public function soft_delete($id)
	{
		$params['status'] = 0;
		return parent::update($params, $id);
	}

	/**
	 * Check if an address has been used
	 *
	 * @param  integer  $address_id ID of the address to be checked
	 *
	 * @return boolean              Whether the address is used
	 */
	public function is_used($address_id)
	{
		$this->load->database();
		$this->db->from('order')
			->where('shipping_address', $address_id)
			->or_where('billing_address', $address_id);

		return $this->db->count_all_results() > 0;
	}
}
