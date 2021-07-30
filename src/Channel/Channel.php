<?php

namespace Atmosphere\Channel;

abstract class Channel
{
	/**
	 * TelegramRequest Channel ID
	 *
	 * @var string
	 */
	protected static $channelID;
	
	/**
	 * Default channel view used by Channel::createPost()
	 *
	 * @var class-string
	 */
	protected static $defaultView;
	
	/**
	 * Create post in specific view
	 *
	 * if $view is string, it will be posted directly
	 *
	 * if $view is an associative array, it will pass to the default view of class
	 *
	 * @param \Atmosphere\View\View|array|string $view
	 */
	public static function createPost ($view)
	{
		if ( is_string($view) )
		{
			telegram(static::$channelID)->send($view);
			return;
		}
		
		if ( is_array($view) )
			$view = new static::$defaultView($view);
		
		telegram(static::$channelID)->view($view);
	}
}
