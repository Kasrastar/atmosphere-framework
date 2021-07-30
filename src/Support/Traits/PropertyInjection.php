<?php

namespace Atmosphere\Support\Traits;

trait PropertyInjection
{
	/**
	 * $args is an associative array which keys are the class property names
	 *
	 * @param array $args
	 */
	public function __construct ()
	{
		if ( func_num_args() == 0 )
			return;
		
		$this->inject(func_get_args()[0]);
	}
	
	private function inject ($args)
	{
		$properties = array_keys(get_class_vars(static::class));
		
		foreach ( $properties as $property )
		{
			$this->$property = $args[ $property ];
		}
	}
}
