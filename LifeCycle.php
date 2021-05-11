<?php


namespace BotFramework;


use BotFramework\Providers\ScenarioServiceProvider;
use BotFramework\Facilities\Supports\CurrentUpdate;
use BotFramework\Providers\MiddlewareServiceProvider;

class LifeCycle
{
	private static $middlewares;
	private static $scenarios;

	public static function takeInto ($updates)
	{
		foreach ($updates as $update)
		{
			CurrentUpdate::set($update);
			if (MiddlewareServiceProvider::putInChains($update, self::$middlewares))
				ScenarioServiceProvider::putInChains($update, self::$scenarios);
		}
	}

	/**
	 * @param string[] $middlewares
	 */
	public static function setMiddlewares ($middlewares)
	{
		self::$middlewares = $middlewares;
	}

	/**
	 * @param string[] $scenarios
	 */
	public static function setScenarios ($scenarios) : void
	{
		self::$scenarios = $scenarios;
	}


}
