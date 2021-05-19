<?php


namespace BotFramework;


use BotFramework\Core\Container\Container;
use Longman\TelegramBot\Entities\Update;
use BotFramework\Core\Container\CurrentUpdate;
use Longman\TelegramBot\Entities\CallbackQuery;
use BotFramework\Providers\ScenarioServiceProvider;
use BotFramework\Providers\MiddlewareServiceProvider;

class LifeCycle
{
	/**
	 * Take received updates into lifecycle
	 *
	 * @param Update[] $updates
	 *
	 * @return void
	 */
	public static function takeInto ($updates)
	{
		foreach ($updates as $update)
		{
			Container::set(Update::class, $update);

			if (CurrentUpdate::isCallbackQuery())
				self::followCallbackQueryLifeCycle($update->getCallbackQuery());
			else
				self::followUpdateLifeCycle($update);
		}
	}

	/**
	 * @param CallbackQuery $query
	 *
	 * @return void
	 */
	private static function followCallbackQueryLifeCycle ($query)
	{
		if (MiddlewareServiceProvider::putCallbackQueryInChains($query))
			ScenarioServiceProvider::putCallbackQueryInChains($query);
	}

	/**
	 * @param Update $update
	 *
	 * @return void
	 */
	private static function followUpdateLifeCycle ($update)
	{
		if (MiddlewareServiceProvider::putInChains($update))
			ScenarioServiceProvider::putInChains($update);
	}
}
