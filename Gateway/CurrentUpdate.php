<?php


namespace Atmosphere\Gateway;


use Longman\TelegramBot\Entities\Update;

class CurrentUpdate
{
	/**
	 * @var Update
	 */
	private static $currentUpdate;

	/**
	 * @param Update $update
	 */
	public static function set (Update $update)
	{
		self::$currentUpdate = $update;
	}

	/**
	 * @return Update
	 */
	public static function get () : Update
	{
		return self::$currentUpdate;
	}
}
