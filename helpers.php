<?php


use Longman\TelegramBot\Entities\Chat;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Entities\Update;
use Illuminate\Database\Capsule\Manager;
use Longman\TelegramBot\Entities\Message;
use BotFramework\Core\Container\Container;
use BotFramework\Core\Gateway\TelegramRequest;
use BotFramework\Core\Gateway\Response;
use Longman\TelegramBot\Entities\CallbackQuery;


if (! function_exists('container'))
{
	/**
	 * Get class from global available container
	 *
	 * @param $class
	 *
	 * @return mixed
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	function container($class)
	{
		return Container::get($class);
	}
}

if ( ! function_exists('telegram'))
{
	/**
	 * Class used to send messages to specific chat
	 *
	 * @return TelegramRequest
	 */
	function telegram ($chat_id = null)
	{
		if (is_null($chat_id))
			return container(TelegramRequest::class);
		else
			return new TelegramRequest($chat_id);
	}
}


if ( ! function_exists('response'))
{
	/**
	 * Smart class to easily send messages to the current chat
	 *
	 * @return \
	 */
	function response ()
	{
		return container(Response::class);
	}
}


if ( ! function_exists('update'))
{
	/**
	 * Get current update instance
	 *
	 * @return Update
	 */
	function update ()
	{
		return container(Update::class);
	}
}


if (! function_exists('callback_query'))
{
	/**
	 * @return CallbackQuery
	 *
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	function callback_query()
	{
		return container(CallbackQuery::class);
	}
}


if ( ! function_exists('message'))
{
	/**
	 * Get current message instance
	 *
	 * @return Message
	 */
	function message ()
	{
		return container(Message::class);
	}
}


if ( ! function_exists('chat'))
{
	/**
	 * Get current chat instance
	 *
	 * @return Chat
	 */
	function chat ()
	{
		return container(Chat::class);
	}
}


if ( ! function_exists('user'))
{
	/**
	 * Get current user instance
	 *
	 * @return User
	 */
	function user ()
	{
		return container(User::class);
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
	function str_contains ($string, $search)
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
	function db_table ($table)
	{
		return Manager::table($table);
	}
}
