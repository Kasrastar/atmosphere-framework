<?php

namespace Atmosphere\View;

use Atmosphere\Support\Traits\PropertyInjection;

class DefaultView extends View
{
	use PropertyInjection;

	private $text;

	protected function template ()
	{
		$this->add(new Type\Text([ $this->text ]));
	}
}
