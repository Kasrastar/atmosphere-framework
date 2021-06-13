<?php


namespace Atmosphere\Conversations;


use Longman\TelegramBot\Entities\Update;
use Atmosphere\Supports\Traits\PropertyInjection;

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
	public function terminatingCondition (Update $update) { return false; }

	/**
	 * Executes when conversation starts
	 *
	 * @return void
	 */
	public function onConversationStart () { }

	/**
	 * Executes when conversation is finished
	 *
	 * @param Update $last_update
	 *
	 * @return void
	 */
	public function onConversationEnd (Update $last_update) { }

	/**
	 * Executes when conversation terminates
	 *
	 * @param Update $last_update
	 */
	public function onConversationTerminate (Update $last_update) { }
}
