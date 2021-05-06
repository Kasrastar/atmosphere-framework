<?php

/*
 * From Laravel Str
 * (with little modifications)
 */

namespace BotFramework\Facilities;


class Str
{
	public static function snake($string) : string
	{
		$string = preg_replace('/\s+/u', '', ucwords($string));
		return strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1_', $string));
	}

	public static function plural($string) : string
	{
		return Supports\Pluralizer::plural($string, 2);
	}

	public static function contains($string, $search) : bool
	{
		return strpos($string, $search) !== false;
	}
}
