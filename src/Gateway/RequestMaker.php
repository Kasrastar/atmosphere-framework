<?php

namespace Atmosphere\Gateway;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RequestMaker
{
	/**
	 * @var string
	 */
	private $endpoint;

	/**
	 * @var Client
	 */
	private $client;

	public function __construct ( $token, Client $client )
	{
		$this->endpoint = "https://api.telegram.org/bot$token/";
		$this->client = $client;
	}

	public function callTelegramApi ( $method_name, $parameters )
	{
		try {
			return $this->client->post($this->endpoint . $method_name, $parameters);
		}
		catch (GuzzleException $ex) {

		}
	}
}
