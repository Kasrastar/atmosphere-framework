<?php

namespace Atmosphere\Support\Traits;

trait Singleton
{
	private static $instance;
	
	/**
	 * Singleton Pattern
	 */
	public static function getInstance (...$arguments)
	{
		if ( is_null(static::$instance) )
			static::$instance = new static(...$arguments);
		
		return static::$instance;
	}
}
