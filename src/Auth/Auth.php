<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2018/2/21
 * Time: 下午 05:54
 */

namespace Kroutony\Api\Cloudflare\Auth;

class Auth {

	/**
	 * Cloudflare Acoount
	 * @var string
	 */
	private $authEmail;

	/**
	 * Cloudflare Api Key
	 * @var string
	 */
	private $authGlobalKey;

	/**
	 * Auth constructor.
	 *
	 * @param $email
	 * @param $globalKey
	 */
	public function __construct($email, $globalKey) {
		$this->setEmail($email);
		$this->setGlobalApiKey($globalKey);
	}

	/**
	 * @param string $email
	 */
	public function setEmail( $email ) {
		$this->authEmail = $email;
		return $this;
	}

	/**
	 * @param string $globalApiKey
	 */
	public function setGlobalApiKey( $globalApiKey ) {
		$this->authGlobalKey = $globalApiKey;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->authEmail;
	}

	/**
	 * @return string
	 */
	public function getGlobalApiKey() {
		return $this->authGlobalKey;
	}

}