<?php


namespace BotFramework\Providers;


use Longman\TelegramBot\Entities\Update;

class MiddlewareServiceProvider
{
	public static function putInChains (Update $update, $registered_middlewares) : bool
	{
		foreach ($registered_middlewares as $middleware)
		{
			if (! (new $middleware)->allow($update))
				return false;
		}

		return true;
	}
}