<?php

namespace Atmosphere\Facility\Factory;

use Faker\Factory;
use Faker\Generator;

abstract class AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class;
	
	/**
	 * Make object/objects
	 *
	 * @param int $count
	 *
	 * @return array|mixed
	 */
	public static function make ($count = 1)
	{
		$objects = [];
		$faker = Factory::create();
		
		for ( $i = 0; $i < $count; $i++ )
		{
			$objects[] = new static::$class(static::definition($faker));
		}
		
		if ( $count == 1 )
			return $objects[0];
		
		return $objects;
	}
	
	/**
	 * Factory definition
	 *
	 * @param Generator $faker
	 *
	 * @return array
	 */
	abstract static function definition (Generator $faker);
}
