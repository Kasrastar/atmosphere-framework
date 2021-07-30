<?php

namespace Atmosphere\Tests;

use Atmosphere\Database\DatabaseServiceProvider;

trait RefreshDatabase
{
	/**
	 * Truncate database
	 *
	 * @return void
	 */
	public function refreshDatabase ()
	{
		app()->make(DatabaseServiceProvider::class)->build(true);
	}
}
