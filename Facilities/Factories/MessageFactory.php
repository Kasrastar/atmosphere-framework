<?php


namespace BotFramework\Facilities\Factories;


use Faker\Generator;

class MessageFactory extends AbstractFactory
{
	protected static $class = \Longman\TelegramBot\Entities\Message::class;

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
