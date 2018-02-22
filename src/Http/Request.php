<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2018/2/21
 * Time: 下午 05:44
 */

namespace Kroutony\Api\Cloudflare\Http;

use Kroutony\Api\Cloudflare\Auth\Auth;

class Request {

	private $curl;

	private $baseUri;

	public function __construct(Auth $auth) {

		$this->baseUri = 'https://api.cloudflare.com/client/v4/';

		$this->initCurl($auth->getEmail(), $auth->getGlobalApiKey());
	}


	private function initCurl($authEmail, $authGlobalKey) {

		$this->curl = curl_init();

		if (FALSE === $this->curl)
			throw new Exception('failed to initialize curl');

		$httpHeader = [];
		$httpHeader[] = 'Accept: application/json';
		$httpHeader[] = 'Content-Type: application/json';
		$httpHeader[] = 'X-Auth-Email: ' . $authEmail;
		$httpHeader[] = 'X-Auth-Key: ' . $authGlobalKey;


		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, $httpHeader);

		return $this;
	}

	public function endpoint($endpoint) {
		$uri = $this->baseUri . $endpoint;
		curl_setopt($this->curl, CURLOPT_URL, $uri);
		return $this;
	}

	private function resetRequestMethod() {
		curl_setopt($this->curl, CURLOPT_POST, NULL);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, NULL);
	}

	public function post() {
		$this->resetRequestMethod();
		curl_setopt($this->curl, CURLOPT_POST, true);
		return $this;
	}

	public function get() {
		$this->resetRequestMethod();
		curl_setopt($this->curl, CURLOPT_POST, false);
		return $this;
	}

	public function put() {
		$this->resetRequestMethod();
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
		return $this;
	}

	public function send($data = null) {
		if($data)
			curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));

		$result = curl_exec($this->curl);

		curl_close($this->curl);

		return json_decode($result);
	}
}