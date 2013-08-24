<?php

class Product_model extends MY_Model
{
	public $productID;
	public $productName;
	public $productPrice;
	public $productDescription;
	public $productStatus;
	public $categoryID;
	public $manufacturerID;
	public $defaultImage;
	public $productImages;


	public function __construct()
	{
		parent::__construct();
		parent::initialize('product', 'productID');
	}

	public function insert($field)
	{
		$field['productAddedDate'] = date('Y-m-d H:i:s');

		return parent::insert($field);
	}

	public function delete($id)
	{
		$this->load->database();

		$query = $this->db->from('object_image')
			->where('objectType', 'product')
			->where('objectID', $id)
			->get();

		foreach ($query->result_array() as $row) {
			$this->delete_image($row['imageID']);
		}

		return parent::delete($id);
	}

	public function get_images($default_only = false)
	{
		$this->load->database();
		$this->db->from('object_image')
			->join('image', 'object_image.imageID = image.imageID');
		if ($default_only) {
			$this->db->join('product', 'defaultImage = image.imageID');
		}
		$this->db->where('objectType', 'product')
			->where('objectID', $this->productID);

		$query = $this->db->get();
		$this->productImages = array();

		foreach ($query->result_array() as $row) {
			$row['image_medium'] = '/public/images/m/' . $row['imageFullName'];
			$row['image_large'] = '/public/images/x/' . $row['imageFullName'];
			$row['default'] = $this->defaultImage == $row['imageID'];
			$imageinfo = getimagesize(FCPATH . 'public/images/m/' . $row['imageFullName']);
			$row['width'] = $imageinfo[0];
			$row['height'] = $imageinfo[1];

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

		$images_dir = FCPATH . 'public/images/';

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
			$f_name = uniqid('p' . $this->productID) . $upload_data['file_ext'];
			$this->create_thumbnails($upload_data['full_path'], $f_name);

			$field = array(
				'imageFullName' => $f_name,
				'imageOriginal' => $upload_data['file_name'],
				'imageExt' => $upload_data['file_ext'],
			);
			$this->db->insert('image', $field);
			$imageID = $this->db->insert_id();

			$field = array(
				'imageID' => $imageID,
				'objectType' => 'product',
				'objectID' => $this->productID,
			);
			$this->db->insert('object_image', $field);

			if (!isset($this->defaultImage)) {
				$field = array(
					'defaultImage' => $imageID
				);
				$this->update($field, $this->productID);
				$this->defaultImage = $imageID;
			}
		}

		return count($this->upload->error_msg) > 0
			 ? $this->upload->error_msg
			 : true;
	}

	public function create_thumbnails($source_image, $f_name = null)
	{
		$images_dir = FCPATH . 'public/images/';

		$this->load->library('image_lib');
		if (!isset($f_name)) {
			$f_name = basename($source_image);
		}

		$sizes = array(
			// dir			width	height
			's' => array(	 '64', 	 '64'	),
			'sm' => array(	'135', 	'135'	),
			'm' => array(	'200', 	'150'	),
			'x' => array(	'500', 	'500'	),
		);

		foreach ($sizes as $s_dir => $size) {
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
		}
	}

	public function delete_image($id)
	{
		$images_dir = FCPATH . 'public/images/';

		$this->load->database();

		$image = $this->db->from('image')
			->where('imageID', $id)
			->get()->row();

		if (empty($image)) {
			return false;
		}

		$this->db->delete('image', array('imageID' => $id));
		$this->db->delete('object_image', array('imageID' => $id));
		$this->db->update(
			'product',
			array('defaultImage' => null),
			array('defaultImage' => $id)
		);

		$dirs = array('s', 'sm', 'm', 'x');
		foreach ($dirs as $dir) {
			unlink($images_dir . $dir . '/' . $image->imageFullName);
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
		$this->order_by = 'productName';
		$this->search_field = 'productName';
		$this->join = array('image', 'defaultImage = imageID', 'left');

		return parent::fetch($params);
	}
}
