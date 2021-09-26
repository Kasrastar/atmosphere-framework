<?php

namespace Atmosphere\Tests;

use Exception;
use Atmosphere\Facade\LifeCycle;
use Longman\TelegramBot\Entities\Update;
use Atmosphere\Database\DatabaseServiceProvider;
use PHPUnit\Framework\TestCase as PhpUnit_TestCase;

/**
 * @method refreshDatabase() // Comes from trait in child class
 */
class TestCase extends PhpUnit_TestCase
{
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
	protected function incomingUpdate ( $updates )
	{
		LifeCycle::takeInto(is_array($updates) ? $updates : [ $updates ]);
	}

	/**
	 * Check child class traits
	 *
	 * @return void
	 */
	private function checkTrait ()
	{
		if ( isset(array_flip(class_uses($this))[ RefreshDatabase::class ]) )
			$this->refreshDatabase();
	}
}
