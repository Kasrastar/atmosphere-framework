<?php


namespace Atmosphere\Tests;


use Atmosphere\Providers\DatabaseServiceProvider;

trait RefreshDatabase
{
	/**
	 * Truncate database
	 *
	 * @return void
	 */
	public function refreshDatabase ()
	{
		DatabaseServiceProvider::build(true);
	}
}
