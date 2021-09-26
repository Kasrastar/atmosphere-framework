<?php

namespace Atmosphere\Facility\Factory;

use Faker\Generator;
use Longman\TelegramBot\Entities\Message;

class MessageFactory extends AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class = Message::class;

	/**
	 * @param Generator $faker
	 *
	 * @return array
	 */
	public static function definition ( Generator $faker )
	{
		$user = UserFactory::definition($faker);
		$chat = ChatFactory::syncWithUser($user);

		return [
			'message_id' => $faker->randomNumber(4),
			'from'       => $user,
			'chat'       => $chat,
			'date'       => $faker->randomNumber(8),
			'text'       => $faker->text,
		];
	}
}
