<?php


namespace Atmosphere\Scenarios\Conditions;


use Longman\TelegramBot\Entities\Update;

abstract class Condition
{
	/**
	 * Check if current update meets current condition or not
	 *
	 * @param Update $update
	 *
	 * @return bool
	 */
	abstract public function check (Update $update);
}
