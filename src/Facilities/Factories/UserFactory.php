<?php


namespace Atmosphere\Facilities\Factories;


use Faker\Generator;

class UserFactory extends AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class = \Longman\TelegramBot\Entities\User::class;

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
