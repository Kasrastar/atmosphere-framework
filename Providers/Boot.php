<?php


namespace BotFramework\Providers;


use Dotenv\Dotenv;
use BotFramework\LifeCycle;
use BotFramework\Application;

class Boot
{
	public static function turnOn ($in_memory_database = false)
	{
		Dotenv::createImmutable(Application::getDir(), 'config.env')->load();
		DatabaseServiceProvider::boot($in_memory_database);

		LifeCycle::$middlewares = Application::getMiddlewares();
		LifeCycle::$scenarios = Application::getScenarios();

		return new self;
	}

	public function getUpdates ()
	{
		return BotServiceProvider::init(self::$projectDir)->handleGetUpdates()->getResult();
	}
}
