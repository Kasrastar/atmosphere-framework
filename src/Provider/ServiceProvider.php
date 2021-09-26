<?php

namespace Atmosphere\Provider;

use Atmosphere\Container\Container;

abstract class ServiceProvider
{
	/**
	 * Service ContainerS
	 *
	 * @var \Illuminate\Container\Container
	 */
	protected $app;

	/**
	 * @param \Atmosphere\Container\Container $app
	 */
	public function __construct ( Container $app )
	{
		$this->app = $app;
	}

	/**
	 * Register bindings into Service Container
	 */
	public function register ()
	{
	}

	/**
	 * Boot application
	 */
	public function boot ()
	{
	}
}
