<?php


namespace BotFramework\App\Views;


use BotFramework\App\Views\View;
use BotFramework\App\Views\Types\Text;
use BotFramework\Core\Supports\Traits\PropertyInjection;

class DefaultView extends View
{
	use PropertyInjection;

	private $text;

	protected function template ()
	{
		$this->add(new Text([$this->text]));
	}
}
