<?php

class Product_model extends CI_model
{

	public $productID;
	public $productName;
	public $productPrice;
	public $productDescription;
	public $productStatus;
	public $categoryID;
	public $manufacturerID;
	public $productImages;

	public $search_term = '';
	public $pagecount;
	public $entries;
	public $limit = 10;
	public $page = 1;
	public $order_by = 'productName';
	public $sort = 'asc';

	public function add($field)
	{
		$this->load->database();
		$field['productAddedDate'] = date('Y-m-d H:i:s');
		return $this->db->insert('product', $field);
	}

	public function insert_id()
	{
		$this->load->database();
		return $this->db->insert_id();
	}

	public function set($id)
	{
		$this->load->database();
		$this->db->from('product')->where('productID', $id);

		$row = $this->db->get()->row();

		$this->productID = $row->productID;
		$this->productName = $row->productName;
		$this->productPrice = $row->productPrice;
		$this->productDescription = $row->productDescription;
		$this->productStatus = $row->productStatus;
		$this->categoryID = $row->categoryID;
		$this->manufacturerID = $row->manufacturerID;

		return $row;
	}

	public function get_images()
	{
		$this->load->database();
		$this->db->from('object_image')
			->join('image', 'object_image.imageID = image.imageID')
			->where('objectType', 'product')
			->where('objectID', $this->productID);

		$query = $this->db->get();
		$this->productImages = array();

		foreach ($query->result_array() as $row) {
			$this->productImages[] = $row;
		}

		return $this->productImages;
	}

	/**
	 *	Update product
	 *
	 *	@param array The array include information to be updated.
	 *	@param integer ID of the product
	 *	@return boolean true for success
	 */
	public function update($field, $id)
	{
		$this->load->database();
		$data = array('productID' => $id);
		return $this->db->update('product', $field, $data);
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

			$field = array(
				'imageID' => $this->db->insert_id(),
				'objectType' => 'product',
				'objectID' => $this->productID,
			);
			$this->db->insert('object_image', $field);
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
			's' => array(	 '50', 	 '50'	),
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

	/**
	 *	Delete manufacturer
	 *
	 *	@param array The array include information to be deleted.
	 *	@return boolean true for success
	 */
	public function delete($field)
	{
		$this->load->database();

		return $this->db->delete('product', $field);
	}

	/**
	 *	Fetch products as array
	 *
	 *	@param array The array which includes param name and its value.
	 *	@return array
	 */
	public function fetch(array $param = array())
	{
		$this->load->database();

		foreach ($param as $key => $value) {
			$this->$key = $value;
		}

		$this->entries = $this->db->from('product')
			->like('productName', $this->search_term)
			->count_all_results();
		$this->pagecount = ceil($this->entries / $this->limit);

		if ($this->entries == 0) {
			return array();
		}

		if ($this->page > $this->pagecount) {
			$this->page = $this->pagecount;
		} else if ($this->page < 1) {
			$this->page = 1;
		}
		$from = ($this->page - 1) * $this->limit;

		$this->db->from('product')
			->like('productName', $this->search_term)
			->join('image', 'defaultImage = imageID', 'left')
			->order_by($this->order_by)
			->limit($this->limit, $from);

		$query = $this->db->get();

		$field = array();
		foreach ($query->result_array() as $res) {
			$field[] = $res;
		}

		return $field;
	}
}
