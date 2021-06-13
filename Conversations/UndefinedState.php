<?php


namespace Atmosphere\Conversations;


class UndefinedState extends \Exception
{
	/**
	 * UndefinedState constructor.
	 *
	 * @param $state
	 */
	public function __construct ($state)
	{
		$this->message = "The state:$state is undefined. 
		It must be Conversation::END or Conversation::TERMINATE or null";
		parent::__construct();
	}
}
