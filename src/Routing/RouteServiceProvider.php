<?php

namespace Atmosphere\Routing;

use Atmosphere\Provider\ServiceProvider;
use Atmosphere\Database\Repository\UserRepository;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * @inheritDoc
	 */
	public function register ()
	{
		$this->app->singleton(Router::class, function () {
			return new Router($this->app->make(UserRepository::class));
		});
	}
}
