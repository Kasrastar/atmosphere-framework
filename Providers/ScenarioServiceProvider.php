<?php


namespace BotFramework\Providers;


class ScenarioServiceProvider
{
	public static function putInChains ($update, $registered_scenarios)
	{
		foreach ($registered_scenarios as $scenario)
		{
			if ((new $scenario($update))->run())
				break;
		}
	}
}