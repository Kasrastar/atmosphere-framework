<?php


namespace BotFramework\Providers;


class BotServiceProvider
{
	/**
	 * Setup full support for PHP-Telegram-Bot package
	 *
	 * @param string $project_dir
	 *
	 * @return \Longman\TelegramBot\Telegram
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	private static function generalInitialization ($project_dir)
	{
		$bot = new \Longman\TelegramBot\Telegram($_ENV['BOT_API_TOKEN'], $_ENV['BOT_USERNAME']);
		$bot->useGetUpdatesWithoutDatabase();

		$bot->addCommandsPath($project_dir . '/App/Commands');

		return $bot;
	}

	/**
	 * @param string $project_dir
	 *
	 * @return \Longman\TelegramBot\Telegram
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public static function initForGetUpdates ($project_dir)
	{
		return self::generalInitialization($project_dir);
	}

	/**
	 * @param string $project_dir
	 *
	 * @return void
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public static function initForWebhook ($project_dir)
	{
		self::generalInitialization($project_dir)->handle();
	}
}
