<?php


namespace Atmosphere\Providers;


use Longman\TelegramBot\Entities\Update;

class ScenarioServiceProvider
{
	/**
	 * Registered scenarios
	 *
	 * @var array
	 */
	private static $scenarios;

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
}