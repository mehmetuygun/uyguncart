<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_db 
{

	/**
	* @param	integer
	* @param  	integer
	* @param 	integer
	* @return	string
	*/	
	public function get_limit ($limit,$page,$total_page)
	{
		if($page == 1 or $page < 1)
			$from = 0;
		else if ($page > $total_page)
			$from = ($total_page * $limit) - $limit;
		else
			$from = ($page * $limit) - $limit;
		return $from.', '.$limit;
	}
}

?>