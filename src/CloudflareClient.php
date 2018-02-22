<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2018/2/8
 * Time: 下午 06:20
 */
namespace Kroutony\Api\Cloudflare;

use Kroutony\Api\Cloudflare\Auth\Auth;
use Kroutony\Api\Cloudflare\EndPoints\Zone;

class CloudflareClient {


	/**
	 * @var Auth $auth
	 */
	private $auth;

	/**
	 * @var Zone $zone
	 */
	public $zone;

	public function __construct(Auth $auth){
		$this->auth = $auth;
		$this->initZone();
	}

	private function initZone() {
		$this->zone = new Zone($this->auth);
	}
}