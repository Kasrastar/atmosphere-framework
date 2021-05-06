<?php


if (! function_exists('telegram'))
{
	/**
	 * Class used to send messages to specific chat
	 *
	 * @return \BotFramework\Facilities\TelegramRequest
	 */
	function telegram() : \BotFramework\Facilities\TelegramRequest
	{
		return new \BotFramework\Facilities\TelegramRequest;
	}
}


if (! function_exists('response'))
{
	/**
	 * Smart class to easily send messages to the current chat
	 *
	 * @return \BotFramework\Facilities\Response
	 */
	function response() : \BotFramework\Facilities\Response
	{
		return new \BotFramework\Facilities\Response;
	}
}


if (! function_exists('update'))
{
	/**
	 * Get current update
	 *
	 * @return \Longman\TelegramBot\Entities\Update
	 */
	function update() : \Longman\TelegramBot\Entities\Update
	{
		return \BotFramework\Facilities\Supports\CurrentUpdate::get();
	}
}

if (! function_exists('chat'))
{
	/**
	 * Get current chat
	 *
	 * @return \Longman\TelegramBot\Entities\Chat
	 */
	function chat() : \Longman\TelegramBot\Entities\Chat
	{
		return update()->getMessage()->getChat();
	}
}


if (! function_exists('user'))
{
	/**
	 * Get current update's user
	 *
	 * @return \Longman\TelegramBot\Entities\User
	 */
	function user() : \Longman\TelegramBot\Entities\User
	{
		return \BotFramework\Facilities\Supports\CurrentUpdate::get()->getMessage()->getFrom();
	}
}
