<?php


namespace Atmosphere\Conversations;


class ConversationError
{
	/**
	 * ConversationError constructor.
	 *
	 * @param string $title
	 * @param string $body
	 */
	public function __construct ($body, $title = 'Error')
	{
		$title = '❌ ' . localize('Conversation', 'Error_Title') . '... ❌' .
			PHP_EOL . ' | — — — — | ' . PHP_EOL . PHP_EOL;

		response()->send($title . $body);
	}
}
