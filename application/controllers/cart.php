<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function Index()
	{
		$this->load->helper('url');;
		$this->load->library('cart');
		$this->load->model('Product_model');

		$data = array(
			'mainview' => 'cart',
		);

		$productID = $this->input->post('productID');
		$quantity = 1;


		if(isset($productID)) {
			$this->Product_model->set($productID);
			if($this->Product_model->productStatus) {
				$this->cart->insert(array(
					'id' => $this->Product_model->productID,
					'qty' => $quantity,
					'price' => $this->Product_model->productPrice,
					'name' => $this->Product_model->productName
					)
				);
				
				// var_dump($this->cart->contents());
			}
		}

		$data['items'] = $this->cart->contents();
		$this->load->view('body', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */