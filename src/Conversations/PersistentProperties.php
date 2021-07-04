<?php


namespace Atmosphere\Conversations;


use Atmosphere\Supports\Traits\PropertyInjection;

trait PersistentProperties
{
	use PropertyInjection;

	/**
	 * onSerialize
	 *
	 * @return array
	 */
	public function jsonSerialize ()
	{
		return get_object_vars($this);
	}
}
