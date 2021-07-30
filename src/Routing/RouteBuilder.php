<?php

namespace Atmosphere\Routing;

use Atmosphere\Core\Application;

class RouteBuilder
{
	/**
	 * Assigned middleware aliases
	 *
	 * @var string[]
	 */
	public $inPending;
	
	/**
	 * @var \Atmosphere\Routing\Router
	 */
	private $router;
	
	/**
	 * RouteBuilder constructor.
	 *
	 * @param \Atmosphere\Routing\Router $router
	 */
	public function __construct (Router $router)
	{
		$this->router = $router;
	}
	
	/**
	 * @param string|string[] $aliases
	 *
	 * @return $this
	 */
	public function middleware ($aliases)
	{
		$this->inPending = is_array($aliases) ? $aliases : [$aliases];
		return $this;
	}
	
	/**
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function root ($callback)
	{
		return $this->buildRoute('text', '/', $callback);
	}
	
	/**
	 * Define a route for bot update and inline query
	 *
	 * @param string   $path
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function any ($path, $callback)
	{
		return $this->buildRoute(__FUNCTION__, $path, $callback);
	}
	
	/**
	 * @param string   $route_type
	 * @param string   $path
	 * @param callable $callback
	 *
	 * @return $this
	 * @throws \Illuminate\Contracts\Container\BindingResolutionException
	 */
	private function buildRoute ($route_type, $path, $callback)
	{
		$route = app()->makeWith(Route::class, [
			'middlewares' => $this->getActualMiddlewares($this->inPending),
			'callback'    => $callback,
			'path'        => self::correctPath($path),
			'type'        => $route_type,
		]);
		
		$this->router->registerRoute($path, $route);
		
		// flush associated middlewares for current route
		// and return $this to make methods chainable
		return $this->flush();
	}
	
	/**
	 * @param string[] $aliases
	 *
	 * @return string[]
	 * @throws \Illuminate\Contracts\Container\BindingResolutionException
	 */
	private function getActualMiddlewares ($aliases)
	{
		$middlewares = app()->make(Application::class)->getMiddlewares();
		$actual_middlewares = [];
		
		foreach ( (array) $aliases as $alias )
		{
			$actual_middlewares[] = $middlewares[ $alias ];
		}
		
		return $actual_middlewares;
	}
	
	public function getRouter ()
	{
		return $this->router;
	}
	
	/**
	 * @param string $path
	 *
	 * @return string
	 */
	public static function correctPath ($path)
	{
		return $path === '/' ? '/' : implode('/', array_filter(explode('/', $path)));
	}
	
	/**
	 * @return $this
	 */
	private function flush ()
	{
		$this->inPending = [];
		return $this;
	}
	
	/**
	 * Define a route for standard update
	 *
	 * @param string   $path
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function text ($path, $callback)
	{
		return $this->buildRoute(__FUNCTION__, $path, $callback);
	}
	
	/**
	 * Define a route for inline query
	 *
	 * @param string   $path
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function photo ($path, $callback)
	{
		return $this->buildRoute(__FUNCTION__, $path, $callback);
	}
	
	/**
	 * Define a route for inline query
	 *
	 * @param string   $path
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function video ($path, $callback)
	{
		return $this->buildRoute(__FUNCTION__, $path, $callback);
	}
}
