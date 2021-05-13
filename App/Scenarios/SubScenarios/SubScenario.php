<?php


namespace BotFramework\App\Scenarios\SubScenarios;


use Longman\TelegramBot\Entities\Update;

abstract class SubScenario
{
	public function __construct ($update)
	{
		$this->handle($update);
	}

	abstract protected function handle (Update $update);
}