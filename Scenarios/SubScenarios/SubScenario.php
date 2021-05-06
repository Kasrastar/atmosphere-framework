<?php


namespace BotFramework\Scenarios\SubScenarios;


use Longman\TelegramBot\Entities\Update;

abstract class SubScenario
{
	public function __construct ($update)
	{
		$this->handle($update);
	}

	protected function handle (Update $update) { }
}