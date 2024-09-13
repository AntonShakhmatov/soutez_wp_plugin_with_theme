<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

// Připojování k API Ecomailu
class EcomailApi
{
	private $api_key;
	private $api_url = 'https://api2.ecomailapp.cz/';

	public function __construct($api_key)
	{
		$this->api_key = $api_key;
	}

	private function sendRequest($url, $request, $data = '')
	{

		$http_headers = array();
		$http_headers[] = "key: " . $this->api_key;
		$http_headers[] = "Content-Type: application/json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);

		if (!empty($data)) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			if ($request == 'POST') {
				curl_setopt($ch, CURLOPT_POST, TRUE);
			} else {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
			}
		}

		$result = curl_exec($ch);
		curl_close($ch);

		// if ($result === false) {
		// 	echo 'Chyba při komunikaci pomocí cURL: ' . curl_error($ch);
		// } else {
		// 	echo 'Spojení pomocí cURL bylo navázáno úspěšně. ';
		// }

		return json_decode($result);
	}

	public function sendTransactionalEmail($data = array(), $click_tracking = TRUE, $open_tracking = TRUE)
	{
		$url = $this->api_url . 'transactional/send-template';
		$post = json_encode(array(
			'message' => array(
				'template_id' => $data['template_id'],
				'subject' => $data['subject'],
				'from_name' => $data['from_name'],
				'from_email' => $data['from_email'],
				'reply_to' => $data['reply_to'],
				'to' => array(
					array(
						'email' => $data['email'],
						'name' => $data['name'],
						// 'cc' => $data['cc'],
					)
				),
				'global_merge_vars' => array(
					array(
						'name' => $data['name'],
						'content' => $data['content']
					)
				),
				'options' => array(
					'click_tracking' => $click_tracking,
					'open_tracking' => $open_tracking
				)
			)
		));
		return $this->sendRequest($url, 'POST', $post);
	}
}
