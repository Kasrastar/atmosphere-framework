<?php


namespace BotFramework\App\Views;


abstract class View
{
	private $template;

	abstract protected function template (Designer $designer);

	public function render () : array
	{
		$this->template = array();
		$this->template(new Designer($this->template));
		return $this->template;
	}
}
