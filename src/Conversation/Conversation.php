<?php

namespace Atmosphere\Conversation;

use Longman\TelegramBot\Entities\Update;
use Atmosphere\Support\Traits\PropertyInjection;

abstract class Conversation
{
	use PropertyInjection;

	/**
	 * Conversation Terminator TOKEN
	 */
	const END = 1;
	const Terminate = -1;

	/**
	 * Terminator
	 *
	 * If returns true, conversation will terminate immediately
	 *
	 * @return bool
	 */
	public function terminator ( Update $update )
	{
		return false;
	}

	/**
	 * Executes when conversation starts
	 *
	 * @return void
	 */
	public function onConversationStart ()
	{
	}

	/**
	 * Executes when conversation is finished
	 *
	 * @param Update $last_update
	 *
	 * @return void
	 */
	public function onConversationEnd ( Update $last_update )
	{
	}

	/**
	 * Executes when conversation is terminated
	 *
	 * @param Update $last_update
	 *
	 * @return void
	 */
	public function onConversationTerminate ( Update $last_update )
	{
	}
}
