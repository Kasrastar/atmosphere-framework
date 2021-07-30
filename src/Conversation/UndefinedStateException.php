<?php

namespace Atmosphere\Conversation;

use Atmosphere\Core\Exception\Exception;

class UndefinedStateException extends Exception
{
	/**
	 * UndefinedState constructor.
	 *
	 * @param $state
	 */
	public function __construct ($state)
	{
		$this->message = "The state:$state is undefined. 
		It must be Conversation::END 
		or Conversation::TERMINATE 
		or instance of ConversationError::class";
		parent::__construct();
	}
}
