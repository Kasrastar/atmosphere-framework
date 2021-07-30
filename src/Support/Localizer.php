<?php

namespace Atmosphere\Support;

use Atmosphere\Core\Application;
use Atmosphere\Support\Traits\Singleton;

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
		// return Application::getLocalizations()[ $scope ][ $key ];
	}
}
