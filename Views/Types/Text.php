<?php


namespace Atmosphere\Views\Types;


class Text extends Type
{
	const PARSE_AS_HTML = 'HTML';
	const PARSE_AS_Markdown = 'MarkdownV2';
	const PARSE_AS_SIMPLE_TEXT = null;

	public function __construct ($lines, $parse_mode = self::PARSE_AS_SIMPLE_TEXT)
	{
		$text = '';

		foreach ($lines as $line)
		{
			$text .= $line . PHP_EOL;
		}

		$this->render = array_filter(compact('text', 'parse_mode'));
	}
}