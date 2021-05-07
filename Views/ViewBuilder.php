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

	public function text ($lines)
	{
		$text = '';
		foreach ($lines as $line)
		{
			$text .= $line . PHP_EOL;
		}
		$this->push(['text' => $text]);
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

	private function push ($array)
	{
		array_push($this->template, $array);
	}
}