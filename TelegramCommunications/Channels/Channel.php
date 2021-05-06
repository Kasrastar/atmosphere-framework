<?php


namespace BotFramework\TelegramCommunications\Channels;


use BotFramework\Views\DefaultView;

abstract class Channel
{
	protected static $channelID;
	protected static $defaultView = DefaultView::class;

	/**
	 * @param array|string $data
	 */
	public static function createPost ($view = null)
	{
		if (is_null($view))
			$view = new static::$defaultView(func_get_args());

		telegram()->send(static::$channelID, $view);
	}
}
