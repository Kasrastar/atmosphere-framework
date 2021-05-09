<?php


namespace BotFramework\Tests;


use BotFramework\Providers\Boot;
use PHPUnit\Framework\TestCase as PhpUnit_TestCase;
use BotFramework\Providers\DatabaseServiceProvider;

class TestCase extends PhpUnit_TestCase
{
	public static function setUpBeforeClass () : void
	{
		Boot::turnOn(true);
		DatabaseServiceProvider::build();
	}

	protected function setUp () : void
	{
		$this->checkTrait();
	}

	private function checkTrait ()
	{
		if (isset(array_flip(class_uses($this))[ RefreshDatabase::class ]))
			$this->refreshDatabase();;
	}
}
