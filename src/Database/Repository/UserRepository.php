<?php

namespace Atmosphere\Database\Repository;

use App\Models\User;
use Atmosphere\Database\Model\Model;
use Atmosphere\Database\Model\CurrentRoute;

class UserRepository
{
	/**
	 * @param int    $telegram_id
	 * @param string $username
	 * @param string $full_name
	 *
	 * @return bool
	 */
	public function registerUserIfNotExists ( $telegram_id, $username, $full_name )
	{
		if ( is_null($this->getUser($telegram_id)) )
		{
			User::create(compact('telegram_id', 'username', 'full_name'));
			return $this->updateUserPath($telegram_id, '/', false);
		}

		return false;
	}

	/**
	 * @param int $telegram_id
	 *
	 * @return Model
	 */
	public function getUser ( $telegram_id )
	{
		return User::whereTelegramId($telegram_id)->first();
	}

	/**
	 * @param int    $telegram_id
	 * @param string $path
	 *
	 * @return bool
	 */
	public function updateUserPath ( $telegram_id, $path, $call_event )
	{
		return $this->associateRoute($this->getUser($telegram_id), $this->firstOrCreateRoute($path, $call_event));
	}

	public function getCurrentPath ( $telegram_id )
	{
		return is_null($route = $this->getUser($telegram_id)->current_route) ? null : $route->path;
	}

	/**
	 * @param Model $user
	 * @param Model $route
	 *
	 * @return bool
	 */
	private function associateRoute ( Model $user, Model $route )
	{
		return $user->current_route()->associate($route)->save();
	}

	/**
	 * @param string $path
	 *
	 * @return Model
	 */
	private function firstOrCreateRoute ( $path, $call_event )
	{
		return CurrentRoute::firstOrCreate([ 'path' => $path, 'call_event' => $call_event ]);
	}
}
