<?php


namespace Atmosphere\Views\Types;


abstract class Type
{
	protected $render;

	public function render ()
	{
		return $this->render;
	}
}