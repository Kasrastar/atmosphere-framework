<?php


namespace BotFramework\Views;


abstract class View
{
	private $template;

	protected function template (ViewBuilder $builder) { }

	public function render () : array
	{
		$this->template = array();
		$this->template(new ViewBuilder($this->template));
		return $this->template;
	}
}
