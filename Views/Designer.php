<?php


namespace BotFramework\Views;


use Longman\TelegramBot\Request;

class Designer
{
	private $template;

	public function __construct (&$template)
	{
		$this->template = &$template;
	}

	public function addText ($lines)
	{
		$text = '';
		foreach ($lines as $line)
		{
			$text .= $line . PHP_EOL;
		}
		$this->push(['text' => $text]);
	}

	public function addPhoto ($path)
	{
		$this->binaryFile('photo', $path);
	}

	public function addVideo ($path)
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