<?php


namespace BotFramework\Tests;


trait RefreshDatabase
{
	/**
	 * Truncate database
	 *
	 * @return void
	 */
	public function refreshDatabase ()
	{
		\BotFramework\Providers\DatabaseServiceProvider::build(true);
	}
}
