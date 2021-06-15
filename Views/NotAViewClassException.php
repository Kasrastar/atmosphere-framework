<?php


namespace Atmosphere\Views;


class NotAViewClassException extends \Exception
{
	public function __construct ($var)
	{
		$this->message = "The $var is not an instance of \Atmosphere\Views\View::class";
		parent::__construct($this->message);
	}
}
