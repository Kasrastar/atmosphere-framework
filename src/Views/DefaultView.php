<?php


namespace Atmosphere\Views;


use Atmosphere\Supports\Traits\PropertyInjection;

class DefaultView extends View
{
	use PropertyInjection;

	private $text;

	protected function template ()
	{
		$this->add(new Types\Text([$this->text]));
	}
}
