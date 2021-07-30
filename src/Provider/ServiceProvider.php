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
	 * ServiceProvider constructor.
	 */
	public function __construct ()
	{
		$this->app = Container::getInstance();
	}
	
	/**
	 * Register bindings into Service Container
	 */
	public function register () { }
	
	/**
	 * Boot application
	 */
	public function boot () { }
}
