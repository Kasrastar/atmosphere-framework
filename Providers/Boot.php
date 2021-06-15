<?php


namespace Atmosphere\Providers;


use Atmosphere\Application;
use Dotenv\Dotenv;
use Longman\TelegramBot\Entities\Update;

class Boot
{
	/**
	 * Turn on service providers
	 *
	 * @param false $in_memory_database
	 *
	 * @return Boot
	 */
	public static function turnOn ($in_memory_database = false)
	{
		Dotenv::createImmutable(Application::getDir(), 'config.env')->load();
		DatabaseServiceProvider::boot($in_memory_database);

		MiddlewareServiceProvider::setMiddlewares(Application::getMiddlewares());

		ScenarioServiceProvider::setScenarios(Application::getScenarios());

		return new self;
	}

	/**
	 * Receive update from webhook
	 *
	 * @return Update[]
	 */
	public function getUpdateViaWebhook ()
	{
		BotServiceProvider::initForWebhook(Application::getDir());
		return [new Update(json_decode(file_get_contents('php://input'), true), $_ENV['BOT_USERNAME'])];
	}

	/**
	 * Fetch updates from telegram manually
	 *
	 * @return Update[]
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function getUpdates ()
	{
		return BotServiceProvider::initForGetUpdates(Application::getDir())->handleGetUpdates()->getResult();
	}
}
