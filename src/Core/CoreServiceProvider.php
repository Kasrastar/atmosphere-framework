<?php

namespace Atmosphere\Core;

use Atmosphere\Provider\ServiceProvider;
use Atmosphere\Core\Exception\ConfigurationException;

class CoreServiceProvider extends ServiceProvider
{
	public function register ()
	{
		if ( !Application::inTesting() && empty($_ENV['BOT_USERNAME']) || empty($_ENV['BOT_API_TOKEN']) )
			throw new ConfigurationException('BOT_USERNAME or BOT_API_TOKEN not found in your config file');
		
		$this->app->instance(Application::class,
			$this->app->makeWith(Application::class, [
				'bot_username' => $_ENV['BOT_USERNAME'] ?? 'FAKE_BOT_USERNAME',
				'bot_token'    => $_ENV['BOT_API_TOKEN'] ?? 'FAKE_BOT_API_TOKEN',
			]));
	}
}
