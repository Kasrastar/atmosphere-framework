<?php


namespace BotFramework\App\Scenarios\Conditions;


use Longman\TelegramBot\Entities\CallbackQuery;

abstract class CallbackQueryCondition
{
	/**
	 * Check if current update meets current condition or not
	 *
	 * @param CallbackQuery $query
	 *
	 * @return bool
	 */
	abstract public function check (CallbackQuery $query);
}
