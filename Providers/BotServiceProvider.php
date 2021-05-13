<?php


namespace BotFramework\Providers;


use Longman\TelegramBot\Telegram;


class BotServiceProvider
{
	public static function init ($project_dir) : Telegram
	{
		$bot = new Telegram($_ENV['BOT_API_TOKEN'], $_ENV['BOT_USERNAME']);
		$bot->useGetUpdatesWithoutDatabase();

		$bot->addCommandsPath($project_dir . '/App/Commands');

		return $bot;
	}

	public static function initForWebhook ($project_dir)
	{
		$bot = new Telegram($_ENV['BOT_API_TOKEN'], $_ENV['BOT_USERNAME']);

		$bot->addCommandsPath($project_dir . '/App/Commands');

		$bot->handle();
	}
}
