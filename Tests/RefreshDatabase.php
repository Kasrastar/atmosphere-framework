<?php


namespace BotFramework\Tests;


trait RefreshDatabase
{
	public function refreshDatabase ()
	{
		\BotFramework\Providers\DatabaseServiceProvider::build(true);
	}
}
