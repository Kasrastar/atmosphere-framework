<?php

namespace Atmosphere\Gateway;

use Curl\Curl;
use Atmosphere\Core\Application;
use Longman\TelegramBot\Telegram;
use Atmosphere\Provider\ServiceProvider;
use Atmosphere\Core\Exception\ConfigurationException;

class TelegramApiServiceProvider extends ServiceProvider
{
	public function boot ()
	{
		if ( !Application::inTesting() && empty($_ENV['BOT_API_TOKEN']) )
		{
			throw new ConfigurationException('BOT_API_TOKEN not found in your config file');
		}

		$application = $this->app->make(Application::class);

		$bot = new Telegram($application->getApiToken(), $application->getBotUsername());
    $mysql_credentials = [
        'host'     => $_ENV['DB_HOST'],
        'port'     => 3306, // optional
        'user'     => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
        'database' => $_ENV['DB_DATABASE'],
    ];

		$bot->enableMySql($mysql_credentials);
		$bot->addCommandClasses($application->getCommands());

		$this->app->instance(Telegram::class, $bot);

		$this->app->bind(RequestMaker::class, function () use ( $application ) {
			return new RequestMaker($application->getApiToken(), new Curl);
		});
	}
}
