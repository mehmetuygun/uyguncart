<?php

class Image_model extends MY_Model
{
	protected static $img_path = 'public/images/';
	protected static $img_sizes = array(
		// dir			width 		height
		64 		 => array(64, 		64),
		135 	 => array(135, 		135),
		200 	 => array(200, 		200),
		300 	 => array(300, 		300),
		500 	 => array(500, 		500),
	);

	public function __construct()
	{
		parent::__construct();
		parent::initialize('object_image', 'image_id');
	}

	public function upload($input, $obj_type, $obj_id, $prefix)
	{
		$this->load->database();

		$images_dir = FCPATH . static::$img_path;

		$config = array(
			'upload_path' => $images_dir . 'original/',
			'allowed_types' => 'gif|jpg|png',
			'max_width' => '2048',
			'max_height' => '2048',
		);

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($input)) {
			$upload_data = $this->upload->data();
			$f_name = uniqid($prefix) . $upload_data['file_ext'];
			$sizes = $this->create_thumbnails($upload_data['full_path'], $f_name);

			$field = array(
				'full_name' => $f_name,
				'original_name' => $upload_data['file_name'],
			);

			foreach ($sizes as $s_dir => $size) {
				$field['size_' . $s_dir] = $size[0] . 'x' . $size[1];
			}

			$this->db->insert('image', $field);
			$imageID = $this->db->insert_id();

			$field = array(
				'image_id' => $imageID,
				'object_type' => $obj_type,
				'object_id' => $obj_id,
			);
			$this->db->insert('object_image', $field);
		}

		return count($this->upload->error_msg) > 0
			 ? $this->upload->error_msg
			 : $imageID;
	}

	public function create_thumbnails($source_image, $f_name = null)
	{
		$images_dir = FCPATH . static::$img_path;

		$this->load->library('image_lib');
		if (!isset($f_name)) {
			$f_name = basename($source_image);
		}

		$sizes = array();
		foreach (static::$img_sizes as $s_dir => $size) {
			list($w, $h) = $size;

			$dir = $images_dir . $s_dir . '/';
			$f_path = $dir . $f_name;

			$config = array(
				'source_image' => $source_image,
				'new_image' => $f_path,
				'width' => $w,
				'height' => $h,
			);

			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$this->image_lib->clear();

			$s = &$sizes[$s_dir];
			list($s[0], $s[1]) = getimagesize($f_path);
		}

		return $sizes;
	}

	public function delete($id)
	{
		$this->load->database();

		$images_dir = FCPATH . static::$img_path;

		$image = $this->db->from('image')
			->where('image_id', $id)
			->get()->row();

		if (empty($image)) {
			return false;
		}

		$this->db->delete('image', array('image_id' => $id));
		$this->db->delete('object_image', array('image_id' => $id));

		foreach (static::$img_sizes as $s_dir => $size) {
			unlink($images_dir . $s_dir . '/' . $image->full_name);
		}

		unlink($images_dir . 'original/' . $image->original_name);

		return true;
	}

	public function fetch($params = array())
	{
		$this->join = array('image', 'object_image.image_id = image.image_id', 'inner');

		$rows = parent::fetch($params);

		foreach ($rows as &$row) {
			foreach (static::$img_sizes as $s_dir => $size) {
				$s_path = static::$img_path . $s_dir . '/' . $row['full_name'];
				if (!file_exists(FCPATH . $s_path)) {
					continue;
				}

				$imageinfo = explode('x', $row['size_' . $s_dir]);
				$row['image_' . $s_dir] = array(
					'path' => $s_path,
					'width' => $imageinfo[0],
					'height' => $imageinfo[1],
				);
			}
		}

		return $rows;
	}
}
