<?php


namespace Atmosphere;


class Application
{
	const NORMAL_MODE = 0;
	const TESTING_MODE = 1;

	/**
	 * @var integer
	 */
	private static $mode;

	/**
	 * Get Bot's working directory
	 *
	 * @return string
	 */
	public static function getDir ()
	{
		return \Bot\Application::getCurrentDir();
	}

	/**
	 * Get Bot's registered middlewares
	 *
	 * @return array
	 */
	public static function getMiddlewares ()
	{
		return \Bot\Application::getMiddlewares();
	}

	/**
	 * Get Bot's registered scenarios
	 *
	 * @return array
	 */
	public static function getScenarios()
	{
		return \Bot\Application::getScenarios();
	}

	/**
	 * Get Bot's registered schemas
	 *
	 * @return string[]
	 */
	public static function getSchemas ()
	{
		return \Bot\Application::getSchemas();
	}

	/**
	 * Load localizations
	 *
	 * @return string[]
	 */
	public static function getLocalizations ()
	{
		return \Bot\Application::getLocalizations();
	}

	/**
	 * Set Application mode
	 *
	 * @param integer $mode
	 *
	 * @throws Exception
	 */
	public static function setMode ($mode)
	{
		if (! in_array($mode, [self::NORMAL_MODE, self::TESTING_MODE]))
			throw new \Exception('Undefined Application Mode');

		self::$mode = $mode;
	}

	/**
	 * Get Application mode
	 *
	 * @return string
	 */
	public static function getMode ()
	{
		return self::$mode;
	}
}
