<?php


namespace Atmosphere;


use Atmosphere\Conversations\ConversationHandler;
use Atmosphere\Container\Container;
use Longman\TelegramBot\Entities\Update;
use Atmosphere\Container\CurrentUpdate;
use Atmosphere\Providers\ScenarioServiceProvider;
use Atmosphere\Providers\MiddlewareServiceProvider;

class LifeCycle
{
	/**
	 * Take received updates into lifecycle
	 *
	 * @param Update[] $updates
	 *
	 * @return void
	 */
	public static function takeInto ($updates)
	{
		foreach ($updates as $update)
		{
			Container::set(Update::class, $update);

			if (! MiddlewareServiceProvider::putInChains($update) || self::tryToFollowConversationSteps($update))
				continue;

			ScenarioServiceProvider::putInChains($update);
		}
	}

	/**
	 * @param Update $update
	 *
	 * @return bool
	 */
	private static function tryToFollowConversationSteps (Update $update)
	{
		$conversation_info = ConversationHandler::activeConversationInfo();

		if (is_null($conversation_info))
			return false;

		ConversationHandler::continueConversation($conversation_info, $update);

		return true;
	}
}
