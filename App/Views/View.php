<?php


namespace BotFramework\App\Views;


use BotFramework\App\Views\Types\Type;

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
	 * Add new element on view
	 *
	 * @param Type $type
	 */
	final protected function add (Type $type)
	{
		$this->template[] = $type->render();
	}

	/**
	 * Design the template
	 *
	 * @return void
	 */
	abstract protected function template ();
}
