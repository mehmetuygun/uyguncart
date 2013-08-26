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
	public function __construct(array $api_credentials)
	{
		$this->getAccessToken(self::$client_id, self::$secret);
	}

	/**
	 * Create new payment
	 * @param  array  $params     Parameters
	 * @param  string $accept_url URL to redirect when payment is accepted
	 * @param  string $cancel_url URL to redirect when payment is canceled
	 * @param  array  $cart       Cart contents
	 * @return array              Payment information
	 * @todo   Add cart contents to be shown on payment
	 * @todo   Fix up return array
	 */
	public function createPayment($params, $accept_url, $cancel_url, $cart)
	{
		$url = '/v1/payments/payment';

		$json = array(
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
					'description' => $params['description'],
				),
			),
		);

		$req_params = array(CURLOPT_POSTFIELDS => json_encode($json));

		$extraHeaders = array(
			'Authorization:Bearer ' . $this->accessToken,
			'Content-Type: application/json',
		);

		return $this->sendRequest($url, $req_params, $extraHeaders);
	}

	/**
	 * Complete the created payment
	 * @param  string $payment_id PAY-xxxxxxx
	 * @param  string $payer_id   xxxxxx
	 * @return array              PayPal response
	 * @todo   Check returned json and return bool
	 */
	public function completePayment($payment_id, $payer_id)
	{
		$url = '/v1/payments/payment/' . $payment_id . '/execute';

		$json = array(
			'payer_id' => $payer_id
		);

		$req_params = array(CURLOPT_POSTFIELDS => json_encode($json));
		$extraHeaders = array(
			'Authorization:Bearer ' . $this->accessToken,
			'Content-Type: application/json',
		);

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

	private function sendRequest($url, $req_params, $extraHeaders = array())
	{
		$url = 'https://' . self::$api_endpoint . $url;

		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => array_merge(
				array(
					'Accept: application/json',
				),
				$extraHeaders
			)
		));

		// Set extra parameters sent to the method
		curl_setopt_array($ch, $req_params);

		$response = curl_exec($ch);


		$json = json_decode($response, true);
		if ($json === null) {
			$json = array();
		}

		return $json;
	}
}
