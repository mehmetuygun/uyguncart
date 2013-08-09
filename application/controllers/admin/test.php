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
		$images_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/public/images/';

		$config = array(
			'upload_path' => $images_dir . 'temp/',
			'allowed_types' => 'gif|jpg|png',
			'max_width' => '2048',
			'max_height' => '2048',
		);

		$this->load->library('upload', $config);

		$this->upload->do_upload('image');

		$upload_data = $this->upload->data();

		$this->load->library('image_lib');

		$config = array(
			'source_image' => $upload_data['full_path'],
			'width' => 200,
			'height' => 200,
			'create_thumb' => true,
		);

		$this->image_lib->initialize($config);

		$this->image_lib->resize();

		$data = array(
			'test' => 'test',
			'test2' => $upload_data,
			'errors' => $this->upload->display_errors()
		);
		$this->load->view('/admin/test', $data);
	}
}
