<?php

namespace Atmosphere\Facade;

/**
 * Class LifeCycle
 *
 * @method static takeInto($updates)
 */
class LifeCycle extends Facade
{
	protected static $admissibleMethods = [
		'takeInto',
	];

	protected static function getFacadeAccessor ()
	{
		return \Atmosphere\Core\LifeCycle::class;
	}
}
