<?php

namespace Atmosphere\Gateway;

use Curl\Curl;

class RequestMaker
{
	/**
	 * @var string
	 */
	private $endpoint;
	
	/**
	 * @var \Curl\Curl
	 */
	private $client;
	
	/**
	 * RequestMaker constructor.
	 *
	 * @param string     $token
	 * @param \Curl\Curl $client
	 */
	public function __construct ($token, Curl $client)
	{
		$this->endpoint = "https://api.telegram.org/bot$token/";
		$this->client = $client;
	}
	
	/**
	 * Call a TelegramRequest api method
	 *
	 * @param string $name
	 * @param array  $parameters
	 *
	 * @return mixed
	 */
	public function callTelegramApi ($name, $parameters)
	{
		return $this->client->post($this->endpoint . $name, $parameters);
	}
}
