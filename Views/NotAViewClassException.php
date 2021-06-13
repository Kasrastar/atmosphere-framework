<?php


namespace Atmosphere\Views;


class NotAViewClassException extends \Exception
{
	protected $message = "The \$var is not a type of \BotFramework\Views\View::class";

	public function __construct ($var)
	{
		$this->message = str_replace('\$var', $var, $this->message);
		parent::__construct($this->message);
	}
}
