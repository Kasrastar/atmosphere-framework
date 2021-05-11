<?php


namespace BotFramework\Facilities\Supports\Traits;


trait PropertyInjection
{
	/**
	 * $args is an associative array which keys are the class property names
	 *
	 * @param array $args
	 */
	public function __construct ($args)
	{
		$this->inject($args);
	}

	private function inject ($args)
	{
		$properties = array_keys(get_class_vars(self::class));

		foreach ($properties as $property)
		{
			$this->$property = $args[$property];
		}
	}
}