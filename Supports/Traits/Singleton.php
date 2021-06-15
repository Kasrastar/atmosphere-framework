<?php


namespace Atmosphere\Supports\Traits;


trait Singleton
{
	private static $instance;

	/**
	 * Singleton Pattern
	 */
	public static function getInstance()
	{
		if (is_null(self::$instance))
			self::$instance = new static(...func_get_args());

		return self::$instance;
	}
}
