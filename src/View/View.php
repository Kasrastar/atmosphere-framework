<?php

namespace Atmosphere\View;

use Atmosphere\View\Type\Type;

abstract class View
{
	/**
	 * @var string
	 */
	private $template;
	
	/**
	 * Render view template
	 *
	 * @return array
	 */
	public function render ()
	{
		$this->template = [];
		$this->template();
		return $this->template;
	}
	
	/**
	 * Design the template
	 *
	 * @return void
	 */
	abstract protected function template ();
	
	/**
	 * Add new element on view
	 *
	 * @param Type $type
	 */
	final protected function add (Type $type)
	{
		$this->template[] = $type->render();
	}
}
