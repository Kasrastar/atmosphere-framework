<?php


namespace BotFramework\App\TelegramCommunications\Channels;


use BotFramework\App\Views\View;

abstract class Channel
{
	protected static $channelID;
	protected static $defaultView;

	/**
	 * Create post in specific view
	 *
	 * if $view is string, it will be posted directly
	 *
	 * if $view is an associative array, it will pass to the default view of class
	 *
	 * @param View|array|string $view
	 */
	public static function createPost ($view)
	{
		if (is_string($view))
		{
			telegram(static::$channelID)->send($view);
			return;
		}

		if (is_array($view))
			$view = new static::$defaultView($view);

		telegram(static::$channelID)->view($view);
	}
}
