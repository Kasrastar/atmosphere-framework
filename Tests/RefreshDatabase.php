<?php


namespace Atmosphere\Tests;


trait RefreshDatabase
{
	/**
	 * Truncate database
	 *
	 * @return void
	 */
	public function refreshDatabase ()
	{
		\Atmosphere\Providers\DatabaseServiceProvider::build(true);
	}
}
