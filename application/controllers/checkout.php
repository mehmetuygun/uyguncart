<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends Main_Controller
{
	public function index()
	{
		$this->load->helper('url');

		$order_id = $this->_create_order();
		redirect('/checkout/address/' . $order_id);
	}

	public function first($order_id)
	{
		$this->load->helper('url');
		$this->load->library('PayPal');
		$this->load_model(array('Order', 'Payment'));

		$payment = array(
			'user_id' => $this->session->userdata('userID'),
			'order_id' => $order_id
		);

		$payment_id = $this->Payment_model->insert($payment);
		$this->Order_model->update(array('payment_id' => $payment_id), $order_id);

		$Cart = $this->cart;
		$PP = new PayPal;
		$payment = $PP->createPayment(
			array(
				'description' => '',
				'amount' => $Cart->total(),
				'currency' => 'USD',
			),
			base_url('/checkout/complete/' . $payment_id),
			base_url('/checkout/cancel/' . $payment_id),
			$Cart->contents()
		);

		if (!$payment) {
			redirect('/checkout/failed/' . $payment_id);
		}

		$this->Payment_model->update($payment, $payment_id);

		header("Location: {$payment['approve_url']}");
		exit;
	}

	public function complete($payment_id)
	{
		$this->load->library('PayPal');
		$this->load->model('Payment_model');
		$this->load->model('OrderItem_model');

		$this->Payment_model->set($payment_id);
		$execute_url = $this->Payment_model->execute_url;

		$payer_id = $this->input->get('PayerID');

		$PP = new PayPal;
		$PP->completePayment($execute_url, $payer_id);

		$this->Payment_model->update(array('status' => 'complete'), $payment_id);

		$items = $this->cart->contents();

		foreach ($items as $item) {
			$this->OrderItem_model->insert(array(
				'order_id' 		=>	$this->Payment_model->order_id,
				'product_id' 	=>	$item['id'],
				'name'			=> 	$item['name'],
				'quantity'		=> 	$item['qty'],
				'unit_price'	=>	$item['price'],
			));
		}

		$data = array(
			'mainview' => 'checkout',
			'title' => 'Checkout',
			'alert_type' => 'alert-success',
			'msg' => 'Payment complete. Payment ID: ' . $payment_id,
		);

		$this->load_view($data);
	}

	public function cancel($payment_id)
	{
		$data = array(
			'mainview' => 'checkout',
			'title' => 'Checkout',
			'alert_type' => 'alert-danger',
			'msg' => 'Payment canceled. Payment ID: ' . $payment_id,
		);

		$this->load_view($data);
	}

	public function failed($payment_id)
	{
		$data = array(
			'mainview' => 'checkout',
			'title' => 'Checkout',
			'alert_type' => 'alert-danger',
			'msg' => 'Payment failed. Payment ID: ' . $payment_id,
		);

		$this->load_view($data);
	}

	public function address($order_id)
	{
		$this->redirect_user('');

		$this->load->model('Address_model');
		$this->load->model('Order_model');
		$this->load->model('Country_model');
		$this->load->library('form_validation');

		if($this->cart->total_items() == 0) {
			redirect();
		}

		$data = array(
			'mainview' => 'checkout_address',
			'title' => 'Checkout Address',
			'countries' => $this->Country_model->get_countries(),
			'js' => array('address.js', 'checkout.js'),
		);

		$data['addresses'] = $this->address_model->fetch(array(
			'filter'=> array('user_id'=> $this->session->userdata('userID'))
		));

		if($this->input->server("REQUEST_METHOD") == 'POST') {

			$config = array(
			   array(
					'field'   => 'saddress',
					'label'   => 'Shipping Address',
					'rules'   => 'required'
				),
				array(
					'field'   => 'baddress',
					'label'   => 'Billing Address',
					'rules'   => 'required'
				),
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == true) {
				$this->Order_model->update(array(
					'shipping_address' 	=> $this->input->post('saddress'),
					'billing_address'	=> $this->input->post('baddress'),
				), $order_id);

				$this->session->set_userdata($session);

				redirect('checkout/paymentmethods/' . $order_id);

			} // end of if

		} // end of request method

		$this->load_view($data);
	}

	public function paymentMethods($order_id)
	{
		$this->redirect_user('');

		if($this->cart->total_items() == 0) {
			redirect();
		}

		$data = array(
			'mainview' => 'paymentmethods',
			'title' => 'Checkout Payment Methods',
		);

		if($this->input->server("REQUEST_METHOD") == 'POST') {
			redirect('checkout/first/' . $order_id);
		}

		$this->load_view($data);
	}

	private function _create_order()
	{
		$this->load->model('Order_model');

		$order_id = $this->Order_model->insert(array(
			'user_id' => $this->session->userdata('userID'),
			'total_price' => $this->cart->total(),
			'shipping_address' => 0,
			'billing_address' => 0,
		));

		return $order_id;
	}
}
