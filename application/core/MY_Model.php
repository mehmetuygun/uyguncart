<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected $table;
	protected $primary_key;

	public function initialize($table, $primary_key)
	{
		$this->table = $table;
		$this->primary_key = $primary_key;
	}

	public function set($id)
	{
		$this->load->database();
		$row = $this->db->from($this->table)
			->where($this->primary_key, $id)
			->get()->row();

		foreach ($row as $col => $field) {
			$this->$col = $field;
		}

		return $row;
	}

	public function insert($fields)
	{
		$this->load->database();
		$this->db->insert($this->table, $fields);

		return $this->db->insert_id();
	}

	public function update($fields, $id)
	{
		$this->load->database();
		$data = array($this->primary_key => $id);

		return $this->db->update($this->table, $fields, $data);
	}

	public function delete($id)
	{
		$this->load->database();
		$data = array($this->primary_key => $id);

		return $this->db->delete($this->table, $data);
	}
}
