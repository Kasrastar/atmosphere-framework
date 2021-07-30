<?php

namespace Atmosphere\Facade;

use Atmosphere\Core\Exception\UndefinedMethodException;

abstract class Facade
{
	/**
	 * @var array
	 */
	protected static $admissibleMethods;
	
	public static function __callStatic ($name, $arguments)
	{
		if ( !in_array($name, static::$admissibleMethods) )
			throw new UndefinedMethodException('UnAccessible method called on facade');
		
		return self::resolveInstance(static::getFacadeAccessor())->$name(...$arguments);
	}
	
	/**
	 * Resolve instance and return it
	 *
	 * @param string $class
	 *
	 * @return mixed
	 */
	private static function resolveInstance ($class)
	{
		return app()->make($class);
	}
	
	/**
	 * @return string
	 */
	abstract protected static function getFacadeAccessor ();
}
