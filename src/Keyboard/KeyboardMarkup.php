<?php

namespace Atmosphere\Keyboard;

interface KeyboardMarkup
{
	/**
	 * Parse templates into array
	 *
	 * @return array
	 */
	public function render ();
}
