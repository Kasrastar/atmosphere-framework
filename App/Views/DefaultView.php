<?php


namespace BotFramework\App\Views;


use BotFramework\App\Views\Designer\Types\Text;
use BotFramework\App\Views\Designer\Designer;

class DefaultView extends View
{
	private $text;

	public function __construct ($text)
	{
		$this->text = $text;
	}

	protected function template (Designer $design)
	{
		$design->add(new Text([$this->text]));
	}
}
