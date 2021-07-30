<?php

namespace Atmosphere\Facade;

use Closure;
use Atmosphere\Routing\RouteBuilder;

/**
 * Class CurrentRoute
 *
 * @method static RouteBuilder middleware(string|array $aliases)
 * @method static RouteBuilder root(array|Closure $callback)
 * @method static RouteBuilder text( string $path, array|Closure $callback )
 * @method static RouteBuilder photo( string $path, array|Closure $callback )
 * @method static RouteBuilder video( string $path, array|Closure $callback )
 * @method static RouteBuilder any( string $path, array|Closure $callback )
 */
class Route extends Facade
{
	/**
	 * @var string[]
	 */
	protected static $admissibleMethods = [
		'middleware',
		'root',
		'any',
		'text',
		'photo',
		'video',
	];
	
	/**
	 * @inheritDoc
	 */
	protected static function getFacadeAccessor ()
	{
		return RouteBuilder::class;
	}
}
