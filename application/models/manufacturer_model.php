<?php
class Manufacturer_model extends CI_model{

	public $manufacturerName;

	/**
	*	Setting manufacturer
	*	@param string The manufacturerID of manufacturer.
	*/
	public function set($id){
		$this->load->database();

		$this->db->from('manufacturer');

		$data = array("manufacturerID"=>$id);

		$this->db->where($data);

		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$this->manufacturerName = $row->manufacturerName;
		}
	}

	/**
	*	Update user's personal information
	*	
	*	@param array The array include information to be updated. 
	*	@param string The userID of user.
	* 	@return boolean
	*/
	public function insert ($field){
		$this->load->database();
		return $this->db->insert('manufacturer',$field);
	}

	/**
	* Get list of manufacturer
	*
	* @param string search query.
	* @param string order by asc, desc, or random.
	* @param string limit of display.
	* @param string page of number.
	* @return array
	*/
	public function fetch ($query = "",$order_by = "random",$limit = 10,$page = 1)
	{
		$this->load->database();

		$this->db->from('manufacturer')
				->like('manufacturerName',$query)
				->order_by('manufacturerName',$order_by);
		
		$total_pages = $this->db->count_all_results();

		if($page == 1 or $page < 1)
			$from = 0;
		else if ($page > $total_pages)
			$from = ($total_pages * $limit) - $limit;
		else
			$from = ($page * $limit) - $limit;

		$this->db->from('manufacturer')
				->like('manufacturerName',$query)
				->order_by('manufacturerName',$order_by)
				->limit($limit,$from);

		$query = $this->db->get();
		return $query->result();
	}

}
?>