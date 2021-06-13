<?php


namespace Atmosphere\Providers;


use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Entities\CallbackQuery;

class MiddlewareServiceProvider
{
	/**
	 * Registered middlewares
	 *
	 * @var array
	 */
	public static $middlewares;

	/**
	 * Register middlewares
	 *
	 * @param string[] $middlewares
	 *
	 * @return void
	 */
	public static function setMiddlewares ($middlewares)
	{
		self::$middlewares = $middlewares;
	}

	/**
	 * @param Update $update
	 *
	 * @return bool
	 */
	public static function putInChains (Update $update)
	{
		foreach (self::$middlewares as $middleware)
		{
			if (! (new $middleware)->allow($update))
				return false;
		}

		return true;
	}
}