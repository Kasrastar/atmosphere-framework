<?php

namespace Atmosphere\Core;

use Dotenv\Dotenv;
use Atmosphere\Contract\Kernel;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Entities\Update;

class Boot
{
	/**
	 * @var string[]
	 */
	private $serviceProviders;
	
	/**
	 * @param string $project_root
	 *
	 * @return \Atmosphere\Core\Boot
	 */
	public static function loadConfig ($project_root)
	{
		Application::$projectRoot = $project_root;
		Dotenv::createImmutable($project_root, 'config.env')->load();
		return new self;
	}
	
	/**
	 * @param \Atmosphere\Contract\Kernel $kernel
	 *
	 * @return $this
	 */
	public function turnOn (Kernel $kernel)
	{
		app()->instance(Kernel::class, $kernel);
		
		$this->serviceProviders = $kernel->serviceProviders();
		
		$this->registerServices();
		$this->bootServices();
		
		return $this;
	}
	
	/**
	 * Register Service Providers
	 */
	private function registerServices ()
	{
		$this->callMethodOnServices('register');
	}
	
	/**
	 * Boot Service Providers
	 */
	private function bootServices ()
	{
		$this->callMethodOnServices('boot');
	}
	
	/**
	 * @param string $method
	 */
	private function callMethodOnServices ($method)
	{
		foreach ( $this->serviceProviders as $service )
		{
			app()->call([ $service, $method ]);
		}
	}
	
	/**
	 * Receive update from webhook
	 *
	 * @return Update[]
	 */
	public function getUpdatesViaWebhook ()
	{
		$bot_username = app()->make(Application::class)->getBotUsername();
		$input = json_decode(file_get_contents('php://input'), true);
		return [ new Update($input, $bot_username) ];
	}
	
	/**
	 * Fetch updates from telegram manually
	 *
	 * @return Update[]
	 * @throws \Longman\TelegramBot\Exception\TelegramException|\Illuminate\Contracts\Container\BindingResolutionException
	 */
	public function getUpdates ()
	{
		return app()->make(Telegram::class)->handleGetUpdates()->getResult();
	}
}
