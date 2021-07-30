<?php

namespace Atmosphere\Routing;

use Longman\TelegramBot\Entities\Update;
use Atmosphere\Database\Repository\UserRepository;

class Router
{
	/**
	 * Associative array in form of
	 * [
	 *    $path  =>  [$routes...],
	 *    $path2 =>  [$routes...]
	 * ]
	 *
	 * @var array
	 */
	private $routes;
	
	/**
	 * @var \Atmosphere\Database\Repository\UserRepository
	 */
	private $user_repository;
	
	/**
	 * Router constructor.
	 *
	 * @param \Atmosphere\Database\Repository\UserRepository $user_repository
	 */
	public function __construct (UserRepository $user_repository)
	{
		$this->user_repository = $user_repository;
	}
	
	/**
	 * Define route in private properties
	 *
	 * @param string                    $path
	 * @param \Atmosphere\Routing\Route $route
	 */
	public function registerRoute ($path, $route)
	{
		$this->routes[ RouteBuilder::correctPath($path) ][] = $route;
	}
	
	/**
	 * @param \Longman\TelegramBot\Entities\Update $update
	 * @param \Illuminate\Database\Eloquent\Model  $user
	 *
	 * @return mixed|null
	 */
	
	public function route (Update $update)
	{
		$telegram_id = $update->getMessage()->getFrom()->getId();
		$current_path = $this->user_repository->getCurrentPath($telegram_id);
		
		$route = $this->searchForRoute($this->detectRouteType($update), $current_path);
		
		// prevent running method if there is no defined route
		// for this specific update
		if (is_null($route)) return null;
		
		$this->user_repository->updateUserPath($telegram_id, $route->getPath());
		
		return $route->dispatch();
	}
	
	/**
	 * Search for a callback in 'routes' property
	 *
	 * @param string $route_type
	 * @param string $path
	 *
	 * @return \Atmosphere\Routing\Route
	 */
	private function searchForRoute ($route_type, $path)
	{
		foreach ( $this->routes[ $path ] as $route )
		{
			if ( $route->getType() === $route_type )
				return $route;
		}
		
		foreach ( $this->routes[ $path ] as $route )
		{
			if ( $route->getType() === 'any' )
				return $route;
		}
		
		return null;
	}
	
	/**
	 * Detect related property to the update
	 *
	 * @param \Longman\TelegramBot\Entities\Update $update
	 *
	 * @return string
	 */
	private function detectRouteType (Update $update)
	{
		return $update->getMessage()->getType();
	}
}
