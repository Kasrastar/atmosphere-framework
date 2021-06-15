<?php


namespace Atmosphere\Providers;


use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

class BotServiceProvider
{
	/**
	 * Setup full support for PHP-Telegram-Bot package
	 *
	 * @param string $project_dir
	 *
	 * @return Telegram
	 * @throws TelegramException
	 */
	private static function generalInitialization ($project_dir)
	{
		$bot = new Telegram($_ENV['BOT_API_TOKEN'], $_ENV['BOT_USERNAME']);
		$bot->useGetUpdatesWithoutDatabase();

		$bot->addCommandsPath($project_dir . '/App/Commands');

		return $bot;
	}

	/**
	 * @param string $project_dir
	 *
	 * @return Telegram
	 * @throws TelegramException
	 */
	public static function initForGetUpdates ($project_dir)
	{
		return self::generalInitialization($project_dir);
	}

	/**
	 * @param string $project_dir
	 *
	 * @return void
	 * @throws TelegramException
	 */
	public static function initForWebhook ($project_dir)
	{
		self::generalInitialization($project_dir)->handle();
	}
}
