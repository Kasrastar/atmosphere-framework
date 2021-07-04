<?php


namespace Atmosphere\Supports;


use Atmosphere\Application;
use Atmosphere\Supports\Traits\Singleton;

class Localizer
{
	use Singleton;

	/**
	 * Localizer constructor.
	 *
	 * @param $scope
	 * @param $key
	 *
	 * @return string
	 */
	public function localize ($scope, $key)
	{
		return Application::getLocalizations()[ $scope ][ $key ];
	}
}
