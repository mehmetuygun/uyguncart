<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('/admin/test', array('test' => '', 'test2' => ''));
	}

	public function upload()
	{
		$this->load->helper(array('form', 'url'));

		$config = array(
			'upload_path' => dirname($_SERVER['SCRIPT_FILENAME'])
				. '/public/images/temp/',
			'allowed_types' => 'gif|jpg|png',
			'max_width' => '2048',
			'max_height' => '2048',
		);

		$this->load->library('upload', $config);

		$this->upload->do_upload('image');


		$data = array(
			'test' => 'test',
			'test2' => $this->upload->data(),
			'errors' => $this->upload->display_errors()
		);
		$this->load->view('/admin/test', $data);
	}
}
