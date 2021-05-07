<?php


namespace BotFramework\Views;


abstract class View
{
	private $template;

	protected function template (Designer $design) { }

	public function render () : array
	{
		$this->template = array();
		$this->template(new Designer($this->template));
		return $this->template;
	}
}
