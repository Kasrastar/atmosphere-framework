<?php


namespace Atmosphere\Views\Types;


class Dice extends Type
{
	public function __construct ($emoji = null)
	{
		$this->render = compact('emoji');
	}
}