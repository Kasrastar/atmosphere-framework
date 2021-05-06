<?php


namespace BotFramework\Middlewares;


use Longman\TelegramBot\Entities\Update;

abstract class Middleware
{
	public function allow (Update $update) : bool { }
}
