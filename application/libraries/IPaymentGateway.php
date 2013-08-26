<?php

interface IPaymentGateway
{
	public function __construct(array $api_credentials);

	public function createPayment($params, $accept_url, $cancel_url, $cart);

	public function completePayment($payment_id, $payer_id);
}
