<?php


namespace Atmosphere\Keyboards;


interface KeyboardMarkup
{
	/**
	 * Parse templates into array
	 *
	 * @return array
	 */
	public function render ();
}
