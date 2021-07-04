<?php


namespace Atmosphere\Facilities\Factories;


use Faker\Generator;

class UpdateFactory extends AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class = \Longman\TelegramBot\Entities\Update::class;

	/**
	 * @param Generator $faker
	 *
	 * @return array
	 */
	public static function definition (Generator $faker)
	{
		return [
			'update_id' => $faker->randomNumber(8),
			'message' => MessageFactory::definition($faker)
		];
	}
}
