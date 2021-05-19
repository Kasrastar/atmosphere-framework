<?php


namespace BotFramework\Providers;


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
	 * Registered callback query middlewares
	 *
	 * @var array
	 */
	public static $callbackQueryMiddlewares;

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
	 * Register callback query middlewares
	 *
	 * @param string[] $middlewares
	 *
	 * @return void
	 */
	public static function setCallbackQueryMiddlewares ($middlewares)
	{
		self::$callbackQueryMiddlewares = $middlewares;
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

	/**
	 * @param CallbackQuery $query
	 *
	 * @return bool
	 */
	public static function putCallbackQueryInChains (CallbackQuery $query)
	{
		foreach (self::$callbackQueryMiddlewares as $middleware)
		{
			if (! (new $middleware)->allow($query))
				return false;
		}

		return true;
	}
}