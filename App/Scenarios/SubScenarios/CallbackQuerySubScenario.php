<?php


namespace BotFramework\App\Scenarios\SubScenarios;


use Longman\TelegramBot\Entities\CallbackQuery;

abstract class CallbackQuerySubScenario
{
	/**
	 * @param CallbackQuery $query
	 *
	 * @return mixed
	 */
	abstract protected function handle (CallbackQuery $query);
}
