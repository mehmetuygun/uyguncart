<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends Main_Controller
{
	public function index()
	{
		$this->load->helper('url');
		redirect('/checkout/first');
	}

	public function first()
	{
		$this->load->helper('url');
		$this->load->library('cart');

		$Cart = $this->cart;

		$PP = new PayPal;
		$PP->createPayment(
			array(
				'description' => '',
				'amount' => $Cart->total(),
				'currency' => 'USD',
			),
			base_url('/checkout/complete'),
			base_url('/checkout/cancel'),
			$Cart->contents()
		);
	}

	public function complete()
	{
		echo 'Payment complete';
	}

	public function cancel()
	{
		echo 'Payment canceled';
	}
}
