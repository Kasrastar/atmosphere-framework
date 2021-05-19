<?php


namespace BotFramework\Providers;


use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Entities\CallbackQuery;

class ScenarioServiceProvider
{
	/**
	 * Registered scenarios
	 *
	 * @var array
	 */
	private static $scenarios;

	/**
	 * Registered callback query scenarios
	 *
	 * @var
	 */
	private static $callbackQueryScenarios;

	/**
	 * Register scenarios
	 *
	 * @param string[] $scenarios
	 *
	 * @return void
	 */
	public static function setScenarios ($scenarios) : void
	{
		self::$scenarios = $scenarios;
	}

	/**
	 * Register callback query scenarios
	 *
	 * @param mixed $scenarios
	 *
	 * @return void
	 */
	public static function setCallbackQueryScenarios ($scenarios)
	{
		self::$callbackQueryScenarios = $scenarios;
	}

	/**
	 * @param Update $update
	 *
	 * @return void
	 */
	public static function putInChains ($update)
	{
		foreach (self::$scenarios as $scenario)
		{
			if ((new $scenario($update))->run())
				break;
		}
	}

	/**
	 * @param CallbackQuery $query
	 *
	 * @return void
	 */
	public static function putCallbackQueryInChains ($query)
	{
		foreach (self::$callbackQueryScenarios as $scenario)
		{
			if ((new $scenario($query))->run())
				break;
		}
	}
}