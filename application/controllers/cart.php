<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends Main_Controller
{
	public function index()
	{
		$this->load->model('Product_model');

		$data = array(
			'mainview' => 'cart',
			'title' => 'Cart',
		);

		$productID = $this->input->post('product_id');
		$add_qty = $this->input->post('add_qty');
		$quantity = $this->input->post('qty');
		$rowid = $this->input->post('rowid');

		if ($add_qty) {
			if (!is_numeric($quantity)) {
				$data['error'] = true;
				$data['error_type'] = 'danger';
				$data['error_message'] = 'The quantity you entered is wrong';
			} else {
				$this->Product_model->set($productID);
				$this->cart->update(array(
					'rowid' => $rowid,
					'qty' => $quantity,
					'price' => $this->Product_model->price,
					'name' => $this->Product_model->name
				));
			}
		} else if (isset($productID)) {
			$this->Product_model->set($productID);
			if ($this->Product_model->status) {
				$this->cart->insert(array(
					'id' => $this->Product_model->product_id,
					'qty' => 1,
					'price' => $this->Product_model->price,
					'name' => $this->Product_model->name
				));
			}
		}
		
		$data['items'] = $this->cart->contents();
		$this->load_view($data);
	}

}
