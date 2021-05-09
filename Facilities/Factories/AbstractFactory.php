<?php


namespace BotFramework\Facilities\Factories;


use Faker\Generator;

abstract class AbstractFactory
{
	protected static $class;

	public static function make ($count = 1)
	{
		$objects = array();
		$faker = \Faker\Factory::create();

		for ($i = 0; $i < $count; $i++)
		{
			$objects[] = new static::$class(static::definition($faker));
		}

		if ($count == 1)
			return $objects[0];

		return $objects;
	}

	abstract static function definition (Generator $faker);
}
