<?php


namespace BotFramework\TelegramCommunications\Channels;


use BotFramework\Views\View;
use BotFramework\Views\DefaultView;

abstract class Channel
{
	protected static $channelID;
	protected static $defaultView = DefaultView::class;

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
		if ( ! $view instanceof View && ! is_string($view))
			$view = new static::$defaultView(func_get_args()[0]);

		telegram()->send(static::$channelID, $view);
	}
}
