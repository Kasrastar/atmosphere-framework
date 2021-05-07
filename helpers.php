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
	 * Get current update instance
	 *
	 * @return \Longman\TelegramBot\Entities\Update
	 */
	function update() : \Longman\TelegramBot\Entities\Update
	{
		return \BotFramework\Facilities\Supports\CurrentUpdate::get();
	}
}

if (! function_exists('message'))
{
	/**
	 * Get current message instance
	 *
	 * @return \Longman\TelegramBot\Entities\Message
	 */
	function message() : \Longman\TelegramBot\Entities\Message
	{
		return update()->getMessage();
	}
}

if (! function_exists('chat'))
{
	/**
	 * Get current chat instance
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
	 * Get current user instance
	 *
	 * @return \Longman\TelegramBot\Entities\User
	 */
	function user() : \Longman\TelegramBot\Entities\User
	{
		return update()->getMessage()->getFrom();
	}
}

if (! function_exists('str_contains'))
{
	function str_contains($string, $search) : bool
	{
		return strpos($string, $search) !== false;
	}
}