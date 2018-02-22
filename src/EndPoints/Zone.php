<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2018/2/8
 * Time: 下午 06:31
 */

namespace Kroutony\Api\Cloudflare\EndPoints;


use Kroutony\Api\Cloudflare\Http\Request;
use Kroutony\Api\Cloudflare\Auth\Auth;

class Zone {

	private $request;

	const endPoints = [
		'list' => 'zones',
		'create' => 'zones',
		'activationCheck' => 'zones/:1/activation_check',
		'detail' => 'zones/:1',
	];

	public function __construct(Auth $auth) {
		$this->request = new Request($auth);
	}

	/**
	 * @param array $data
	 *
	 * @return object
	 */
	public function list($data = null) {
		return $this->request
			->endpoint(self::endPoints['list'])
			->get()
			->send($data);
	}

	/**
	 * @param string $zoneIdentifier
	 *
	 * @return object
	 */
	public function detail($zoneIdentifier) {

		$endpoint = self::endPoints['detail'];

		$endpoint = str_replace(':1', $zoneIdentifier, $endpoint);

		return $this->request
			->endpoint($endpoint)
			->get()
			->send();
	}

	/**
	 * @param array $data
	 *
	 * @return object
	 * @throws \Exception
	 */
	public function create($data) {
		$requiredFields = [
			'name'
		];
		foreach($requiredFields as $requiredField) {
			if(!array_key_exists($requiredField, $data)) {
				throw new \Exception("Parameter '". $requiredField . "' was not found");
			}
		}

		return $this->request
			->endpoint(self::endPoints['create'])
			->post()
			->send($data);
	}

	/**
	 * @param string $zoneIdentifier
	 *
	 * @return object
	 */
	public function activationCheck($zoneIdentifier) {

		$endpoint = self::endPoints['activationCheck'];

		$endpoint = str_replace(':1', $zoneIdentifier, $endpoint);

		return $this->request
			->endpoint($endpoint)
			->put()
			->send();
	}
}