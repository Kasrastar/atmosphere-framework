<?php

namespace Atmosphere\Conversation;

class ConversationError
{
	/**
	 * @var string
	 */
	private $error;
	
	/**
	 * ConversationError constructor.
	 *
	 * @param string      $body
	 * @param string|null $title
	 */
	public function __construct ($body, $title = null)
	{
		if ( is_null($title) )
			$title = localize('Conversation', 'Error_Title');
		
		$title = '❌ ' . $title . '... ❌' . PHP_EOL . ' | — — — — | ' . PHP_EOL . PHP_EOL;
		
		$this->error = $title . $body;
	}
	
	/**
	 * Getter
	 *
	 * @return string
	 */
	public function getError ()
	{
		return $this->error;
	}
}
