<?php

namespace Atmosphere\Core\Exception;

use Throwable;

class Exception extends \Exception
{
	public function __construct ($message = "", $code = 0, Throwable $previous = null)
	{
		$this->message = "\e[101m" . $message . "\e[49m";
		parent::__construct($message, $code, $previous);
	}
}
