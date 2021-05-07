<?php


namespace BotFramework\Views;


class DefaultView extends View
{
	private $text;

	public function __construct ($text)
	{
		$this->text = $text;
	}

	protected function template (Designer $design)
	{
		$design->addText([ $this->text ]);
	}
}
