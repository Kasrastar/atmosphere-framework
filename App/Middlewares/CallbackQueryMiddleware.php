<?php


namespace BotFramework\App\Middlewares;


use Longman\TelegramBot\Entities\CallbackQuery;

abstract class CallbackQueryMiddleware
{
	/**
	 * Decide to allow incoming callback query or not
	 *
	 * @param CallbackQuery $query
	 *
	 * @return boolean
	 */
	abstract public function allow (CallbackQuery $query);
}
