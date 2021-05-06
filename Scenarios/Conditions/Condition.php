<?php


namespace BotFramework\Scenarios\Conditions;


abstract class Condition
{
	public function check (\Longman\TelegramBot\Entities\Update $update) : bool { }
}
