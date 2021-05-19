<?php


namespace BotFramework\App\Keyboards;


interface KeyboardMarkup
{
	/**
	 * Parse templates into array
	 *
	 * @return array
	 */
	public function render ();
}
