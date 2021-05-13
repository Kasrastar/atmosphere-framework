<?php


namespace BotFramework\Providers;


use Dotenv\Dotenv;
use BotFramework\LifeCycle;
use BotFramework\Application;
use Longman\TelegramBot\Entities\Update;

class Boot
{
	public static function turnOn ($in_memory_database = false)
	{
		Dotenv::createImmutable(Application::getDir(), 'config.env')->load();
		DatabaseServiceProvider::boot($in_memory_database);

		LifeCycle::setMiddlewares(Application::getMiddlewares());
		LifeCycle::setScenarios(Application::getScenarios());

		return new self;
	}

	public function getUpdatesWithWebhook ()
	{
		BotServiceProvider::initForWebhook(Application::getDir());
		return [new Update(json_decode(file_get_contents('php://input'), true), $_ENV['BOT_USERNAME'])];
	}

	public function getUpdates ()
	{
		return BotServiceProvider::init(Application::getDir())->handleGetUpdates()->getResult();
	}
}
