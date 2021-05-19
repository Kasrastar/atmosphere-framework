<?php


namespace BotFramework\App\Middlewares;


use Longman\TelegramBot\Entities\Update;

abstract class Middleware
{
	/**
	 * Deicde to allow incoming update or not
	 *
	 * @param Update $update
	 *
	 * @return bool
	 */
	abstract public function allow (Update $update);
}
