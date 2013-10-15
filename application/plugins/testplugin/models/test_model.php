<?php

class Test_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		parent::initialize('test', 'id');
	}
}
