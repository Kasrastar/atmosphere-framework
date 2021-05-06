<?php


namespace BotFramework\Views;


use Longman\TelegramBot\Request;

class ViewBuilder
{
	private $template;

	public function __construct (&$template)
	{
		$this->template = &$template;
	}

	public function line ($line)
	{
		return $line . PHP_EOL;
	}

	public function string ($string)
	{
		return $string;
	}

	public function text ($closure)
	{
		$this->push([ 'text' => implode('', $closure()) ]);
	}

	public function photo ($path)
	{
		$this->binaryFile('photo', $path);
	}

	public function video ($path)
	{
		$this->binaryFile('video', $path);
	}

	private function binaryFile ($key, $path)
	{
		$this->push([ $key => Request::encodeFile($path) ]);
	}

	private function push ($value)
	{
		array_push($this->template, $value);
	}
}