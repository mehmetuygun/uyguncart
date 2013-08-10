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
		$sizes = array(
			// 		width	height
			array(	 '50', 	 '50'),
			array(	'200', 	'150'),
			array(	'500', 	'500'),
		);
		$images_dir = FCPATH . 'public/images/';

		$config = array(
			'upload_path' => $images_dir . 'temp/',
			'allowed_types' => 'gif|jpg|png',
			'max_width' => '2048',
			'max_height' => '2048',
		);

		$this->load->library('upload', $config);
		$this->upload->do_upload('image');

		$upload_data = $this->upload->data();
		$file_name = uniqid() . $upload_data['file_ext'];

		$this->load->library('image_lib');
		$resize_errors = array();

		foreach ($sizes as $size) {
			list($w, $h) = $size;

			$dir = $images_dir . "{$w}x{$h}/";
			if (!is_dir($dir)) {
				mkdir($dir, 0777, true);
			}
			$f_path = $dir . $file_name;

			$config = array(
				'source_image' => $upload_data['full_path'],
				'new_image' => $f_path,
				'width' => $w,
				'height' => $h,
			);

			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				$resize_errors[] = $this->image_lib->display_errors();
			}
			$this->image_lib->clear();
		}

		$data = array(
			'test' => 'test',
			'test2' => $upload_data,
			'errors' => $this->upload->display_errors(),
			'resize_errors' => $resize_errors
		);
		$this->load->view('/admin/test', $data);
	}
}
