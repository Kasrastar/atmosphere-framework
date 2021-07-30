<?php

namespace Tests\Stubs\App;

use Atmosphere\Contract\Kernel;

class FakeKernel implements Kernel
{
	/**
	 * @inheritDoc
	 */
	public function middlewares ()
	{
		return [];
	}
	
	/**
	 * @inheritDoc
	 */
	public function globalMiddlewares ()
	{
		return [];
	}
	
	/**
	 * @inheritDoc
	 */
	public function schemas ()
	{
		return [
			UserSchema::class
		];
	}
	
	/**
	 * @inheritDoc
	 */
	public function serviceProviders ()
	{
		return [
			\Atmosphere\Core\CoreServiceProvider::class,
			\Atmosphere\Gateway\TelegramApiServiceProvider::class,
			\Atmosphere\Database\DatabaseServiceProvider::class,
			\Atmosphere\Routing\RouteServiceProvider::class,
		];
	}
}
