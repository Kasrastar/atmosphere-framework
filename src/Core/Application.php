<?php

namespace Atmosphere\Core;

use Atmosphere\Contract\Kernel;

class Application
{
	/**
	 * @var string
	 */
	public static $projectRoot;
	
	/**
	 * @var bool
	 */
	private static $inTesting = false;
	
	/**
	 * @var \Atmosphere\Contract\Kernel
	 */
	private $kernel;
	
	/**
	 * @var string
	 */
	private $botUsername;
	
	/**
	 * @var string
	 */
	private $botToken;
	
	/**
	 * Set application mode to testing
	 */
	public static function enableTestingMode ()
	{
		self::$inTesting = true;
	}
	
	/**
	 * @return bool
	 */
	public static function inTesting ()
	{
		return self::$inTesting;
	}
	
	/**
	 * Application constructor.
	 *
	 * @param \Atmosphere\Contract\Kernel $kernel
	 * @param string $bot_username
	 * @param string $bot_token
	 */
	public function __construct (Kernel $kernel, $bot_username, $bot_token)
	{
		$this->kernel = $kernel;
		$this->botUsername = $bot_username;
		$this->botToken = $bot_token;
	}
	
	/**
	 * @return string
	 */
	public function getBotUsername ()
	{
		return $this->botUsername;
	}
	
	public function getApiToken ()
	{
		return $this->botToken;
	}
	
	/**
	 * Get Bot's registered middlewares
	 *
	 * @return array
	 */
	public function getMiddlewares ()
	{
		return $this->kernel->middlewares();
	}
	
	/**
	 * @return string[]
	 */
	public function getGlobalMiddlewares ()
	{
		return $this->kernel->globalMiddlewares();
	}
	
	/**
	 * @return string[]
	 */
	public function getSchemas ()
	{
		return $this->kernel->schemas();
	}
	
	/**
	 * @return string[]
	 */
	public function getServiceProviders ()
	{
		return $this->kernel->serviceProviders();
	}

	/**
	 * Load localizations
	 *
	 * @return string[]
	 */
	public function getLocalizations ()
	{
		// return \Bot\Application::getLocalizations();
	}
}
