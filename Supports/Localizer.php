<?php


namespace Atmosphere\Supports;


use Atmosphere\Application;

class Localizer
{
	/**
	 * Localizer constructor.
	 *
	 * @param $scope
	 * @param $key
	 *
	 * @return string
	 */
	public function __construct ($scope, $key)
	{
		return Application::getLocalizations()[ $scope ][ $key ];
	}
}
