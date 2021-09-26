<?php

namespace Atmosphere\Facility\Factory;

use Faker\Generator;
use Longman\TelegramBot\Entities\Update;

class UpdateFactory extends AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class = Update::class;

	/**
	 * @param Generator $faker
	 *
	 * @return array
	 */
	public static function definition ( Generator $faker )
	{
		return [
			'update_id' => $faker->randomNumber(8),
			'message'   => MessageFactory::definition($faker),
		];
	}
}
