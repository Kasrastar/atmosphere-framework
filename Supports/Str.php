<?php

/*
 * From Laravel Facades
 * (with some modifications)
 */

namespace Atmosphere\Supports;


class Str
{
	use Traits\Singleton;

	public function snake($string) : string
	{
		$string = preg_replace('/\s+/u', '', ucwords($string));
		return strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1_', $string));
	}

	public function plural($string) : string
	{
		return Pluralizer::plural($string, 2);
	}
}
