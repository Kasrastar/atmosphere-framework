<?php


namespace BotFramework\App\Middlewares;


use Longman\TelegramBot\Entities\Update;

abstract class Middleware
{
	abstract public function allow (Update $update) : bool;
}
