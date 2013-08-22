<?php

class Setting_model extends MY_Model
{
	public $userEmail;
	public $userFirstName;
	public $userLastName;


	public function __construct()
	{
		parent::__construct();
		parent::initialize('user', 'userID');
	}
}
