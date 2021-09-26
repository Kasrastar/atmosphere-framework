<?php

namespace Atmosphere\Middleware;

use Longman\TelegramBot\Entities\Update;

abstract class Middleware
{
	/**
	 * Decide to allow incoming update or not
	 *
	 * @param Update $update
	 *
	 * @return bool
	 */
	abstract public function allow ( Update $update );
}
