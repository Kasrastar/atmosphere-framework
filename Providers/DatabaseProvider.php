<?php


namespace Bot\Providers;


use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseProvider
{
	public static function boot ()
	{
		$capsule = new Capsule;

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

		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}
}