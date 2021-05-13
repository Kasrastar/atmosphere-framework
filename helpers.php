<?php

if ( ! function_exists('telegram'))
{
	/**
	 * Class used to send messages to specific chat
	 *
	 * @return \BotFramework\Core\Gateway\TelegramRequest
	 */
	function telegram ($chat_id = '')
	{
		if ($chat_id == '')
			return \BotFramework\Providers\Container::get(\BotFramework\Core\Gateway\TelegramRequest::class);
		else
			return new \BotFramework\Core\Gateway\TelegramRequest($chat_id);
	}
}


if ( ! function_exists('response'))
{
	/**
	 * Smart class to easily send messages to the current chat
	 *
	 * @return \BotFramework\Core\Gateway\Response
	 */
	function response ()
	{
		return \BotFramework\Providers\Container::get(\BotFramework\Core\Gateway\Response::class);
	}
}


if ( ! function_exists('update'))
{
	/**
	 * Get current update instance
	 *
	 * @return \Longman\TelegramBot\Entities\Update
	 */
	function update () : \Longman\TelegramBot\Entities\Update
	{
		return \BotFramework\Core\Gateway\CurrentUpdate::get();
	}
}

if ( ! function_exists('message'))
{
	/**
	 * Get current message instance
	 *
	 * @return \Longman\TelegramBot\Entities\Message
	 */
	function message () : \Longman\TelegramBot\Entities\Message
	{
		return update()->getMessage();
	}
}

if ( ! function_exists('chat'))
{
	/**
	 * Get current chat instance
	 *
	 * @return \Longman\TelegramBot\Entities\Chat
	 */
	function chat () : \Longman\TelegramBot\Entities\Chat
	{
		return message()->getChat();
	}
}


if ( ! function_exists('user'))
{
	/**
	 * Get current user instance
	 *
	 * @return \Longman\TelegramBot\Entities\User
	 */
	function user () : \Longman\TelegramBot\Entities\User
	{
		return message()->getFrom();
	}
}

if ( ! function_exists('str_contains'))
{
	/**
	 * Checks $string if containing $search or not
	 *
	 * @param $string
	 * @param $search
	 *
	 * @return bool
	 */
	function str_contains ($string, $search) : bool
	{
		return strpos($string, $search) !== false;
	}
}

if ( ! function_exists('db_table'))
{
	/**
	 * Query Builder
	 *
	 * @param string $table
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	function db_table ($table) : \Illuminate\Database\Query\Builder
	{
		return \Illuminate\Database\Capsule\Manager::table($table);
	}
}
