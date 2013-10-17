<?php

class Product_model extends MY_Model
{
	public $product_id;
	public $name;
	public $price;
	public $description;
	public $status;
	public $category_id;
	public $manufacturer_id;
	public $default_image;
	public $productImages;

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
		parent::initialize('product', 'product_id');
	}

	public function insert($field)
	{
		$field['added_date'] = date('Y-m-d H:i:s');

		return parent::insert($field);
	}

	public function delete($id)
	{
		$this->load->database();

		$query = $this->db->from('object_image')
			->where('object_type', 'product')
			->where('object_id', $id)
			->get();

		foreach ($query->result_array() as $row) {
			$this->delete_image($row['image_id']);
		}

		return parent::delete($id);
	}

	public function get_images($default_only = false)
	{
		$this->load->database();
		$this->db->from('object_image')
			->join('image', 'object_image.image_id = image.image_id');

		if ($default_only) {
			$this->db->select('object_image.*, image.*, product.default_image')
				->join('product', 'default_image = image.image_id');
		}

		$this->db->where('object_type', 'product')
			->where('object_id', $this->product_id);

		$query = $this->db->get();
		$this->productImages = array();

		foreach ($query->result_array() as $row) {
			$row['default'] = $this->default_image == $row['image_id'];

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

			$this->productImages[] = $row;
		}

		return $this->productImages;
	}

	public function upload_image($inputs = null)
	{
		$this->load->database();

		if (!isset($inputs)) {
			$inputs = 'image';
		}

		if (!is_array($inputs)) {
			$inputs = array($inputs);
		}

		$images_dir = FCPATH . static::$img_path;

		$config = array(
			'upload_path' => $images_dir . 'original/',
			'allowed_types' => 'gif|jpg|png',
			'max_width' => '2048',
			'max_height' => '2048',
		);

		$this->load->library('upload', $config);

		foreach ($inputs as $input) {
			if (!$this->upload->do_upload($input)) {
				$upload_data = $this->upload->data();
				continue;
			}

			$upload_data = $this->upload->data();
			$f_name = uniqid('p' . $this->product_id) . $upload_data['file_ext'];
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
				'object_type' => 'product',
				'object_id' => $this->product_id,
			);
			$this->db->insert('object_image', $field);

			if (!isset($this->default_image)) {
				$field = array(
					'default_image' => $imageID
				);
				$this->update($field, $this->product_id);
				$this->default_image = $imageID;
			}
		}

		return count($this->upload->error_msg) > 0
			 ? $this->upload->error_msg
			 : true;
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

	public function delete_image($id)
	{
		$images_dir = FCPATH . static::$img_path;

		$this->load->database();

		$image = $this->db->from('image')
			->where('image_id', $id)
			->get()->row();

		if (empty($image)) {
			return false;
		}

		$this->db->delete('image', array('image_id' => $id));
		$this->db->delete('object_image', array('image_id' => $id));
		$this->db->update(
			'product',
			array('default_image' => null),
			array('default_image' => $id)
		);

		foreach (static::$img_sizes as $s_dir => $size) {
			unlink($images_dir . $s_dir . '/' . $image->imageFullName);
		}

		unlink($images_dir . 'original/' . $image->imageOriginal);

		return true;
	}

	/**
	 *	Fetch products as array
	 *
	 *	@param array The array which includes param name and its value.
	 *	@return array
	 */
	public function fetch(array $params = array())
	{
		$this->order_by = 'name';
		$this->search_field = 'name';
		$this->join = array('image', 'default_image = image_id', 'left');

		return parent::fetch($params);
	}
}
