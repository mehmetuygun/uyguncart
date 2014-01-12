<?php

class Setting_model extends CI_Model
{
	protected $table;

	public function __construct()
	{
		$this->table = 'setting';

		$this->load->database();
	}

	/**
	 * Gets the value of specified setting
	 *
	 * @param  string $name    Name of the setting
	 *
	 * @return string          Value of the setting
	 */
	public function get($name)
	{
		$row = $this->db
			->from($this->table)
			->where('name', $name)
			->get()
			->row();

		return $row['value'];
	}

	/**
	 * Upserts settings given in the array
	 *
	 * @param  array $settings Associative array of settings
	 *
	 * @return void
	 */
	public function update($settings)
	{
		foreach ($settings as $name => $value) {
			$data = array('value' => $value);
			$cond = array('name' => $name);

			$this->db->update($this->table, $data, $cond);
			if ($this->db->affected_rows()) {
				continue;
			}

			// Check whether the setting exists when no rows were affected
			$exists = $this->db->from($this->table)
				->where('name', $name)
				->count_all_results();

			if (!$exists) {
				$setting_row = array_merge($cond, $data);
				$this->db->insert($this->table, $setting_row);
			}
		}
	}
}
