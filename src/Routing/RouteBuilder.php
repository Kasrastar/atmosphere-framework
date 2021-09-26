<?php

namespace Atmosphere\Routing;

use Atmosphere\Core\Application;

class RouteBuilder
{
	/**
	 * Available middlewares to assign
	 *
	 * @var string[]
	 */
	private $availableMiddlewares;

	/**
	 * Assigned middleware aliases
	 *
	 * @var string[]
	 */
	private $inPendingMiddlewares;

	/**
	 * @var callable
	 */
	private $inPendingEvent;

	/**
	 * @var Router
	 */
	private $router;

	/**
	 * RouteBuilder constructor.
	 *
	 * @param Router $router
	 */
	public function __construct ( Application $application, Router $router )
	{
		$this->availableMiddlewares = $application->getMiddlewares();
		$this->router = $router;
	}

	/**
	 * @param string $path
	 *
	 * @return string
	 */
	public static function correctPath ( $path )
	{
		return $path === '/' ? '/' : implode('/', array_filter(explode('/', $path)));
	}

	/**
	 * @param string|string[] $aliases
	 *
	 * @return $this
	 */
	public function middleware ( $aliases )
	{
		$this->inPendingMiddlewares = is_array($aliases) ? $aliases : [ $aliases ];
		return $this;
	}

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function event ( $callback )
	{
		$this->inPendingEvent = $callback;
		return $this;
	}

	/**
	 * @param callable $callback
	 */
	public function root ( $callback )
	{
		$this->buildAndRegister('text', '/', $callback);
	}

	/**
	 * @param string   $path
	 * @param callable $callback
	 */
	public function any ( $path, $callback )
	{
		$this->buildAndRegister(__FUNCTION__, $path, $callback);
	}

	/**
	 * @param string   $path
	 * @param callable $callback
	 */
	public function text ( $path, $callback )
	{
		$this->buildAndRegister(__FUNCTION__, $path, $callback);
	}

	/**
	 * @param string   $path
	 * @param callable $callback
	 */
	public function video ( $path, $callback )
	{
		$this->buildAndRegister(__FUNCTION__, $path, $callback);
	}

	/**
	 * @param string   $path
	 * @param callable $callback
	 */
	public function photo ( $path, $callback )
	{
		$this->buildAndRegister(__FUNCTION__, $path, $callback);
	}

	/**
	 * @param string   $route_type
	 * @param string   $path
	 * @param callable $callback
	 */
	private function buildAndRegister ( $route_type, $path, $callback )
	{
		$path = self::correctPath($path);

		$this->router->registerRoute($path, new Route(
			$route_type,
			$this->getActualMiddlewares(),
			$this->inPendingEvent,
			$path,
			$callback,
		));
	}

	/**
	 * @return string[]
	 */
	private function getActualMiddlewares ()
	{
		foreach ( $this->inPendingMiddlewares as $alias )
			$actual_middlewares[] = $this->availableMiddlewares[ $alias ];

		return $actual_middlewares ?? [];
	}
}
