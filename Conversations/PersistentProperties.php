<?php


namespace Atmosphere\Conversations;


trait PersistentProperties
{
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
