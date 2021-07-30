<?php

namespace Atmosphere\View\Type;

class Text extends Type
{
	const PARSE_AS_HTML = 'HTML';
	const PARSE_AS_Markdown = 'MarkdownV2';
	const PARSE_AS_SIMPLE_TEXT = null;
	
	/**
	 * Text constructor.
	 *
	 * @param string|string[] $lines
	 * @param null|string     $parse_mode
	 */
	public function __construct ($lines, $parse_mode = self::PARSE_AS_SIMPLE_TEXT)
	{
		if ( is_string($lines) )
			$lines = [ $lines ];
		
		$text = '';
		
		foreach ( $lines as $line )
		{
			$text .= $line . PHP_EOL;
		}
		
		$this->render = array_filter(compact('text', 'parse_mode'));
	}
}
