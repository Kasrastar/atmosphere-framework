<?php

namespace Atmosphere\Routing;

class Route
{
	/**
	 * @var string[]
	 */
	private $middlewares;
	
	/**
	 * @var callable
	 */
	private $callback;
	
	/**
	 * @var string
	 */
	private $path;
	
	/**
	 * @var string
	 */
	private $type;
	
	/**
	 * Route constructor.
	 *
	 * @param string[] $middlewares
	 * @param callable $callback
	 * @param string   $path
	 * @param string   $type
	 */
	public function __construct ($middlewares, $callback, $path, $type)
	{
		$this->middlewares = $middlewares;
		$this->callback = $callback;
		$this->path = $path;
		$this->type = $type;
	}
	
	public function getPath ()
	{
		return $this->path;
	}
	
	public function getType ()
	{
		return $this->type;
	}
	
	public function dispatch ()
	{
		if ( $this->dispatchToMiddlewares() )
			return app()->call($this->callback);
		
		return null;
	}
	
	private function dispatchToMiddlewares ()
	{
		foreach ( $this->middlewares as $middleware )
		{
			if ( !app()->call([ $middleware, 'allow' ]) )
				return false;
		}
		
		return true;
	}
}
