<?php

require 'IPaymentGateway.php';

class PayPal implements IPaymentGateway
{
	private $accessToken;
	private $tokenExpireTime;

	private static $api_endpoint = 'api.sandbox.paypal.com';

	private static $client_id = 'AZ2PMBC-xsfXtk2upiiDqFpjyHDMUZ0-GN1mt924h_Pt9pXjQItUu-MiB0v9';
	private static $secret = 'EE77zhD4trg4aRljbQgEkW6-Ai4M1Msj-GbEL_-lFWQln7kMZTPQOGzwVU_k';


	/**
	 * Initialize PayPal
	 * @param array $api_credentials API credentials to be used
	 *                               on authentication with PayPal
	 * @todo use api credentials instead
	 */
	public function __construct(array $api_credentials = array())
	{
		$this->getAccessToken(self::$client_id, self::$secret);
	}

	/**
	 * Create new payment
	 * @param  array  $params     Parameters
	 * @param  string $accept_url URL to redirect when payment is accepted
	 * @param  string $cancel_url URL to redirect when payment is canceled
	 * @param  array  $cart       Cart contents
	 *								array(
	 *									array(
	 *										'quantity' => 1,
	 *										'name' => 'Test Item',
	 *										'price' => 10,
	 *										'currency' => 'USD',
	 *									),
	 *									array(
	 *										...
	 *									),
	 *									...
	 *								)
	 * @return array              Fields to be saved to payment table
	 */
	public function createPayment($params, $accept_url, $cancel_url, $cart)
	{
		$url = '/v1/payments/payment';

		$request = array(
			'intent' => 'sale',
			'redirect_urls' => array(
				'return_url' => $accept_url,
				'cancel_url' => $cancel_url,
			),
			'payer' => array(
				'payment_method' => 'paypal',
			),
			'transactions' => array(
				array(
					'amount' => array(
						'total' => $params['amount'],
						'currency' => $params['currency'],
					),
					'item_list' => array(
						'items' => $this->prepareItems($cart),
					),
					'description' => $params['description'],
				),
			),
		);

		$response = $this->doApiCall($url, $request);

		if (!$response || !isset($response['id'])) {
			return false;
		}

		$payment = array(
			'gateway_ref' => $response['id'],
		);

		foreach ($response['links'] as $url) {
			switch ($url['rel']) {
				case 'self':
					$p_url = &$payment['info_url'];
					break;
				case 'approval_url':
					$p_url = &$payment['approve_url'];
					break;
				case 'execute':
					$p_url = &$payment['execute_url'];
					break;
			}
			$p_url = $url['href'];
		}

		return $payment;
	}

	/**
	 * Complete the created payment
	 * @param  string $payment_id PAY-xxxxxxx
	 * @param  string $payer_id   xxxxxx
	 * @return array              Whether the payment successfully completed
	 */
	public function completePayment($execute_url, $payer_id)
	{
		$request = array(
			'payer_id' => $payer_id
		);

		$response = $this->doApiCall($execute_url, $request);

		return $response['state'] == 'approved';
	}

	private function prepareItems($cart)
	{
		$items = array();

		foreach ($cart as $item) {
			$items[] = array(
				'quantity' => $item['qty'],
				'name' => $item['name'],
				'price' => $item['price'],
				'currency' => 'USD',
			);
		}

		return $items;
	}

	private function doApiCall($url, $request)
	{
		$extraHeaders = array(
			'Authorization: Bearer ' . $this->accessToken,
			'Content-Type: application/json',
		);

		$req_params = array(CURLOPT_POSTFIELDS => json_encode($request));

		return $this->sendRequest($url, $req_params, $extraHeaders);
	}

	private function getAccessToken($client_id, $secret)
	{
		$req_params = array(
			CURLOPT_USERPWD => self::$client_id . ':' . self::$secret,
			CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
		);

		$response = $this->sendRequest('/v1/oauth2/token', $req_params);

		$this->accessToken = $response['access_token'];
		$this->tokenExpireTime = time() + $response['expires_in'];

		return $this->accessToken;
	}

	private function sendRequest($url, $req_params, $extraHeaders = null)
	{
		if (strpos($url, 'http') !== 0) {
			$url = 'https://' . self::$api_endpoint . $url;
		}

		$headers = array(
			'Accept: application/json',
		);

		if (isset($extraHeaders)) {
			$headers = array_merge($headers, $extraHeaders);
		}

		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_SSL_VERIFYPEER => false,
		));

		// Set extra parameters sent to the method
		curl_setopt_array($ch, $req_params);

		$response = curl_exec($ch);
		$json = json_decode($response, true);

		return $json;
	}
}
