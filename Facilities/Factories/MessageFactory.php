<?php


namespace Atmosphere\Facilities\Factories;


use Faker\Generator;

class MessageFactory extends AbstractFactory
{
	/**
	 * @var class-string
	 */
	protected static $class = \Longman\TelegramBot\Entities\Message::class;

	/**
	 * @param Generator $faker
	 *
	 * @return array
	 */
	public static function definition (Generator $faker)
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
