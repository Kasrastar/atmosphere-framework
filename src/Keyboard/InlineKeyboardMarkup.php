<?php

namespace Atmosphere\Keyboard;

abstract class InlineKeyboardMarkup implements KeyboardMarkup
{
	/**
	 * @return array
	 */
	public function render ()
	{
		return [
			'inline_keyboard' => $this->template(),
		];
	}
	
	/**
	 * @return array
	 */
	abstract protected function template ();
}