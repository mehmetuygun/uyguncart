<?php

class Setting_model extends CI_Model
{
	protected $table;

	public function __construct()
	{
		$this->table = 'setting';

		$this->load->database();
	}

	public function get($setting)
	{
		$row = $this->db
			->from($this->table)
			->where('name', $setting)
			->get()
			->row();

		return $row['value'];
	}

	public function update($settings)
	{
		foreach ($settings as $name => $value) {
			$data = array('value' => $value);
			$cond = array('name' => $name);

			$this->db->update($this->table, $data, $cond);
		}
	}
}
