<?php

class Setting_model extends MY_Model
{
	public $email;
	public $first_name;
	public $last_name;


	public function __construct()
	{
		parent::__construct();
		parent::initialize('user', 'user_id');
	}
}
