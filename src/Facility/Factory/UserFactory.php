<?php

namespace Atmosphere\Facility\Factory;

use Faker\Generator;
use Longman\TelegramBot\Entities\User;

class UserFactory extends AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class = User::class;
	
	/**
	 * @param Generator $faker
	 *
	 * @return array
	 */
	public static function definition (Generator $faker)
	{
		return [
			'id'            => $faker->randomNumber(8),
			'is_bot'        => 'false',
			'first_name'    => $faker->firstName,
			'last_name'     => $faker->lastName,
			'username'      => $faker->userName,
			'language_code' => 'en',
		];
	}
}
