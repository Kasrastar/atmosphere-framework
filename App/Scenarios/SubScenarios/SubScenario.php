<?php


namespace BotFramework\App\Scenarios\SubScenarios;


use Longman\TelegramBot\Entities\Update;

abstract class SubScenario
{
	abstract protected function handle (Update $update);
}
