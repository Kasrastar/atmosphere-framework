<?php


namespace Atmosphere\Scenarios\SubScenarios;


use Longman\TelegramBot\Entities\Update;

abstract class SubScenario
{
	/**
	 * @param Update $update
	 *
	 * @return void
	 */
	abstract protected function handle (Update $update);
}
