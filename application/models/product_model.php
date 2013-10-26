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

	public function get_images()
	{
		$this->load->model('Image_model');

		$params = array(
			'filter' => array(
				array('object_type' => 'product'),
				array('object_id' => $this->product_id),
			),
		);

		$this->productImages = $this->Image_model->fetch($params);

		foreach ($this->productImages as &$row) {
			$row['default'] = $this->default_image == $row['image_id'];
		}

		return $this->productImages;
	}

	public function upload_image($inputs = null)
	{
		$this->load->database();
		$this->load->model('Image_model');

		if (!isset($inputs)) {
			$inputs = 'image';
		}

		if (!is_array($inputs)) {
			$inputs = array($inputs);
		}

		$prefix = 'p' . $this->product_id;

		$upload_errors = array();
		foreach ($inputs as $input) {
			$imageID = $this->Image_model->upload(
				$input,
				'product',
				$this->product_id,
				$prefix
			);

			if (!is_numeric($imageID)) {
				$upload_errors = array_merge($upload_errors, $imageID);
				continue;
			}

			// Set the new image as default if there isn't one
			if (!isset($this->default_image)) {
				$field = array(
					'default_image' => $imageID
				);
				$this->update($field, $this->product_id);
				$this->default_image = $imageID;
			}
		}

		return $upload_errors ? $upload_errors : true;
	}

	public function delete_image($id)
	{
		$this->load->database();
		$this->load->model('Image_model');

		if (!$this->Image_model->delete($id)) {
			return false;
		}

		$this->db->update(
			'product',
			array('default_image' => null),
			array('default_image' => $id)
		);

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
