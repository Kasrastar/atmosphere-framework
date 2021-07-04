<?php


namespace Atmosphere\Facilities\Factories;


use Faker\Generator;

class ChatFactory extends AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class = \Longman\TelegramBot\Entities\Chat::class;

	/**
	 * @param Generator $faker
	 *
	 * @return array
	 */
	public static function definition (Generator $faker)
	{
		return [
			'id'         => $faker->randomNumber(8),
			'first_name' => $faker->firstName,
			'last_name'  => $faker->lastName,
			'username'   => $faker->userName,
			'type'       => 'private',
		];
	}

	/**
	 * Make this chat compatible with specific user
	 *
	 * @param $user_definition
	 *
	 * @return array
	 */
	public static function syncWithUser ($user_definition)
	{
		unset($user_definition['is_bot']);
		unset($user_definition['language_code']);

		$user_definition['type'] = 'private';

		return $user_definition;
	}
}
