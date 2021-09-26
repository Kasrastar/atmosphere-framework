<?php

namespace Atmosphere\Keyboard;

abstract class ReplyKeyboardMarkup implements KeyboardMarkup
{
	/**
	 * @var boolean
	 */
	protected $resize_keyboard = true;

	/**
	 * @var boolean
	 */
	protected $one_time_keyboard = false;

	/**
	 * @var boolean
	 */
	protected $selective = false;

	/**
	 * @return array
	 */
	public function render ()
	{
		return [
			'keyboard'          => $this->template(),
			'resize_keyboard'   => $this->resize_keyboard,
			'one_time_keyboard' => $this->one_time_keyboard,
			'selective'         => $this->selective,
		];
	}

	/**
	 * @return array
	 */
	abstract protected function template ();
}
