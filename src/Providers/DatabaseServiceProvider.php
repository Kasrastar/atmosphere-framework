<?php


namespace Atmosphere\Providers;


use Atmosphere\Application;
use Illuminate\Database\Capsule\Manager;

class DatabaseServiceProvider
{
	/**
	 * Setup full support for Laravel Eloquent
	 *
	 * @param boolean $in_memory
	 *
	 * @return void
	 */
	public static function boot ($in_memory)
	{
		$capsule = new Manager;

		if ($in_memory)
		{
			$capsule->addConnection([
				'driver'   => 'sqlite',
				'database' => ':memory:',
			]);
		}

		else if ($_ENV['DB_DRIVER'] == 'sqlite')
		{
			$capsule->addConnection([
				'driver'   => 'sqlite',
				'database' => Application::getDir() . '/Database/database.sqlite',
			]);
		}

		else
		{
			$capsule->addConnection([
				'driver'    => $_ENV['DB_DRIVER'],
				'host'      => $_ENV['DB_HOST'],
				'database'  => $_ENV['DB_DATABASE'],
				'username'  => $_ENV['DB_USERNAME'],
				'password'  => $_ENV['DB_PASSWORD'],
				'charset'   => $_ENV['DB_CHARSET'],
				'collation' => $_ENV['DB_COLLATION'],
				'prefix'    => $_ENV['DB_PREFIX'],
			]);
		}

		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}

	/**
	 * Build database according to schemas
	 *
	 * @param boolean $rebuild
	 *
	 * @return void
	 */
	public static function build ($rebuild = false)
	{
		$schemas = \Atmosphere\Application::getSchemas();
		$schemas = array_merge($schemas, [\Atmosphere\Database\Schemas\ConversationSchema::class]);

		if ($rebuild)
			foreach ($schemas as $schema)
			{
				( new $schema )->down()->up();
			}

		else
			foreach ($schemas as $schema)
			{
				( new $schema )->createIfNotExists();
			}
	}
}
