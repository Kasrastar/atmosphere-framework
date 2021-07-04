<?php


namespace Atmosphere\Tests;


use Atmosphere\LifeCycle;
use Atmosphere\Application;
use Atmosphere\Providers\Boot;
use Atmosphere\Providers\DatabaseServiceProvider;
use PHPUnit\Framework\TestCase as PhpUnit_TestCase;
use Longman\TelegramBot\Entities\Update;

/**
 * @method refreshDatabase() // Comes from trait in child class
 */
class TestCase extends PhpUnit_TestCase
{
	/**
	 * Boot virtual Bot
	 *
	 * @return void
	 * @throws \Exception
	 */
	public static function setUpBeforeClass () : void
	{
		Application::setMode(Application::TESTING_MODE);
		Boot::turnOn(true);
		DatabaseServiceProvider::build();
	}

	/**
	 * Execute before each test
	 *
	 * @return void
	 */
	protected function setUp () : void
	{
		$this->checkTrait();
	}

	/**
	 * Assume incoming update in test
	 *
	 * @param Update|Update[] $updates
	 *
	 * @return void
	 */
	protected function incomingUpdate ($updates)
	{
		$updates = is_array($updates) ? $updates : [$updates];

		LifeCycle::takeInto($updates);
	}

	/**
	 * Check child class traits
	 *
	 * @return void
	 */
	private function checkTrait ()
	{
		if (isset(array_flip(class_uses($this))[ RefreshDatabase::class ]))
			$this->refreshDatabase();
	}
}
