<?php

namespace Atmosphere\Database;

use Atmosphere\Core\Application;
use Atmosphere\Provider\ServiceProvider;
use Illuminate\Database\Capsule\Manager;
use Atmosphere\Database\Schema\ConversationSchema;
use Atmosphere\Database\Schema\CurrentRouteSchema;

class DatabaseServiceProvider extends ServiceProvider
{
	/**
	 * @var bool
	 */
	public static $in_memory_database = false;

	public function boot ()
	{
		$capsule = new Manager($this->app);

		if ( Application::inTesting() )
			$capsule->addConnection([
				'driver'   => 'sqlite',
				'database' => ':memory:',
			]);

		else
		{
			if ( $_ENV['DB_DRIVER'] == 'sqlite' )
				$capsule->addConnection([
					'driver'   => 'sqlite',
					'database' => $_ENV['PROJECT_ROOT'] . '/database/database.sqlite',
				]);

			else
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

		$capsule->bootEloquent();
		$capsule->setAsGlobal();
	}

	/**
	 * @param bool $rebuild
	 */
	public function build ( Application $application, $rebuild = false )
	{
		$schemas = array_merge([
			ConversationSchema::class,
			CurrentRouteSchema::class,
		], $application->getSchemas());

		if ( $rebuild )
			foreach ( $schemas as $schema )
				(new $schema)->down()->up();

		else
			foreach ( $schemas as $schema )
				(new $schema)->createIfNotExists();
	}
}
