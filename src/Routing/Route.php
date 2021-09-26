<?php

namespace Atmosphere\Routing;

use Closure;

class Route
{
	/**
	 * @var string[]
	 */
	private $middlewares;

	/**
	 * @var callable
	 */
	private $event;

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
	 * @param string   $type
	 * @param string[] $middlewares
	 * @param callable $event
	 * @param string   $path
	 * @param callable $callback
	 */
	public function __construct ( $type, $middlewares, $event, $path, $callback )
	{
		$this->type = $type;
		$this->event = $event;
		$this->middlewares = $middlewares;
		$this->path = $path;
		$this->callback = $callback;
	}

	public function getPath ()
	{
		return $this->path;
	}

	public function getType ()
	{
		return $this->type;
	}

	/**
	 * @param boolean $call_event
	 * @return mixed|null
	 */
	public function dispatch ( $call_event )
	{
		if ( !$this->dispatchToMiddlewares() )
			return null;

		if ( $call_event )
			$this->invokeCallback($this->event);

		return $this->invokeCallback($this->callback);
	}

	private function dispatchToMiddlewares ()
	{
		foreach ( $this->middlewares as $middleware )
			if ( !$this->invokeCallback([ $middleware, 'allow' ]) )
				return false;

		return true;
	}

	/**
	 * @param callable $callback
	 * @return mixed
	 */
	private function invokeCallback ( $callback )
	{
		if ( !$callback instanceof Closure )
			$callback = [ app()->make($callback[0]), $callback[1] ];

		return app()->call($callback);
	}
}
