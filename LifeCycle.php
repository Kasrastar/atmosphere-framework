<?php


namespace BotFramework;


use BotFramework\Providers\ScenarioServiceProvider;
use BotFramework\Facilities\Supports\CurrentUpdate;
use BotFramework\Providers\MiddlewareServiceProvider;

class LifeCycle
{
	public static $middlewares;
	public static $scenarios;

	public static function takeInto ($updates)
	{
		foreach ($updates as $update)
		{
			CurrentUpdate::set($update);
			if (MiddlewareServiceProvider::putInChains($update, self::$middlewares))
				ScenarioServiceProvider::putInChains($update, self::$scenarios);
		}
	}
}
