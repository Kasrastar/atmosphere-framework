<?php

namespace Atmosphere\View\Type;

class Dice extends Type
{
	public function __construct ($emoji = null)
	{
		$this->render = compact('emoji');
	}
}
