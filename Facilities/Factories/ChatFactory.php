<?php


namespace BotFramework\Facilities\Factories;


use Faker\Generator;

class ChatFactory extends AbstractFactory
{
	protected static $class = \Longman\TelegramBot\Entities\Chat::class;

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

	public static function syncWithUser ($user_definition)
	{
		unset($user_definition['is_bot']);
		unset($user_definition['language_code']);

		$user_definition['type'] = 'private';

		return $user_definition;
	}
}
