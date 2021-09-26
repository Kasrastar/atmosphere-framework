<?php

use DI\NotFoundException;
use DI\DependencyException;
use Atmosphere\Gateway\Telegram;
use Atmosphere\Support\Localizer;
use Atmosphere\Container\Container;
use Illuminate\Database\Query\Builder;
use Longman\TelegramBot\Entities\Chat;
use Longman\TelegramBot\Entities\User;
use Illuminate\Database\Capsule\Manager;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Entities\Message;
use Longman\TelegramBot\Entities\CallbackQuery;
use Atmosphere\Database\Repository\UserRepository;

if ( !function_exists('app') )
{
	/**
	 * Get class from global available container
	 *
	 * @return Container
	 */
	function app ()
	{
		return Container::getInstance();
	}
}

if ( !function_exists('telegram') )
{
	/**
	 * Class used to send messages to specific chat
	 *
	 * @param int $chat_id
	 *
	 * @return Telegram
	 */
	function telegram ( $chat_id )
	{
		return app()->makeWith(Telegram::class, [ 'chat_id' => $chat_id ]);
	}
}

if ( !function_exists('response') )
{
	/**
	 * Smart class to easily send messages to the current chat
	 *
	 * @return Telegram
	 */
	function response ()
	{
		return telegram(chat()->getId());
	}
}

if ( !function_exists('update') )
{
	/**
	 * Get current update instance
	 *
	 * @return Update
	 */
	function update ()
	{
		return app()->make(Update::class);
	}
}

if ( !function_exists('callback_query') )
{
	/**
	 * @return CallbackQuery
	 *
	 * @throws DependencyException
	 * @throws NotFoundException
	 */
	function callback_query ()
	{
		return update()->getCallbackQuery();
	}
}

if ( !function_exists('message') )
{
	/**
	 * Get current message instance
	 *
	 * @return Message
	 */
	function message ()
	{
		return update()->getMessage();
	}
}

if ( !function_exists('chat') )
{
	/**
	 * Get current chat instance
	 *
	 * @return Chat
	 */
	function chat ()
	{
		return message()->getChat();
	}
}

if ( !function_exists('user') )
{
	/**
	 * Get current user instance
	 *
	 * @return User
	 */
	function user ()
	{
		return message()->getFrom();
	}
}

if ( !function_exists('route') )
{
	/**
	 * @param string $path
	 */
	function route ( $path, $call_event = false )
	{
		return app()->make(UserRepository::class)
		            ->updateUserPath(user()->getId(), $path, $call_event);
	}
}

if ( !function_exists('string_contains') )
{
	/**
	 * Checks $string if containing $search or not
	 *
	 * @param $string
	 * @param $search
	 *
	 * @return bool
	 */
	function string_contains ( $string, $search )
	{
		return strpos($string, $search) !== false;
	}
}

if ( !function_exists('string_starts_with') )
{
	function string_starts_with ( $string, $start_string )
	{
		$len = strlen($start_string);
		return substr($string, 0, $len) === $start_string;
	}
}

if ( !function_exists('db_table') )
{
	/**
	 * Query Builder
	 *
	 * @param string $table
	 *
	 * @return Builder
	 */
	function db_table ( $table )
	{
		return Manager::table($table);
	}
}

if ( !function_exists('localize') )
{
	/**
	 * localization
	 *
	 * @param $scope
	 * @param $key
	 *
	 * @return string
	 */
	function localize ( $scope, $key )
	{
		return Localizer::getInstance()->localize($scope, $key);
	}
}

if ( !function_exists('dd') )
{
	/**
	 * Laravel Die & Dump
	 */
	function dd ()
	{
		dump(...func_get_args()) && die();
	}
}
