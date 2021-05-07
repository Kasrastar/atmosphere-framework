<?php


namespace BotFramework\Views;


trait InjectProperties
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
		var_dump($properties);
		foreach ($properties as $property)
		{
			$this->$property = $args[$property];
		}
	}
}