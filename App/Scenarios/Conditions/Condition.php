<?php


namespace BotFramework\App\Scenarios\Conditions;


abstract class Condition
{
	abstract public function check (\Longman\TelegramBot\Entities\Update $update) : bool;
}
