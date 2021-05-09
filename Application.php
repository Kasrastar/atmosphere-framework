<?php


namespace BotFramework;


class Application
{
	public static function getDir ()
	{
		return \Bot\Application::getCurrentDir();
	}

	public static function getMiddlewares ()
	{
		return \Bot\Application::getMiddlewares();
	}

	public static function getScenarios()
	{
		return \Bot\Application::getScenarios();
	}

	public static function getSchemas ()
	{
		return \Bot\Application::getSchemas();
	}
}