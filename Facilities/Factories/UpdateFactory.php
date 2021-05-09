<?php


namespace BotFramework\Facilities\Factories;


use Faker\Generator;

class UpdateFactory extends AbstractFactory
{
	protected static $class = \Longman\TelegramBot\Entities\Update::class;

	public static function definition (Generator $faker)
	{
		return [
			'update_id' => $faker->randomNumber(8),
			'message' => MessageFactory::definition($faker)
		];
	}
}
