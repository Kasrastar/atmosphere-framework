<?php


namespace BotFramework\App\Scenarios;


use Longman\TelegramBot\Entities\CallbackQuery;

abstract class CallbackQueryScenario extends AbstractScenario
{
	/**
	 * Handle current callback query
	 *
	 * @param CallbackQuery $update
	 *
	 * @return void
	 */
	abstract protected function handle (CallbackQuery $update);
}
