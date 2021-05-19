<?php


namespace BotFramework\App\Scenarios;


use Longman\TelegramBot\Entities\Update;


abstract class Scenario extends AbstractScenario
{
	/**
	 * Handle current update
	 *
	 * @param Update $update
	 *
	 * @return void
	 */
	abstract protected function handle (Update $update);
}
