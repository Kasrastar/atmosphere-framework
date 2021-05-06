<?php


namespace BotFramework\Providers;


use Dotenv\Dotenv;

class Boot
{
	public static function getUpdates ($project_dir)
	{
		Dotenv::createImmutable($project_dir, 'config.env')->load();
		DatabaseServiceProvider::boot();
		return BotServiceProvider::init($project_dir)->handleGetUpdates()->getResult();
	}
}