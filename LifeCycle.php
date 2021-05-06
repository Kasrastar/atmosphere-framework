<?php


namespace BotFramework;


use BotFramework\Providers\ScenarioServiceProvider;
use BotFramework\Facilities\Supports\CurrentUpdate;
use BotFramework\Providers\MiddlewareServiceProvider;

class LifeCycle
{
	public static function takeInto ($updates, $middlewares, $scenarios)
	{
		foreach ($updates as $update)
		{
			CurrentUpdate::set($update);
			if (MiddlewareServiceProvider::putInChains($update, $middlewares))
				ScenarioServiceProvider::putInChains($update, $scenarios);
		}
	}
}
