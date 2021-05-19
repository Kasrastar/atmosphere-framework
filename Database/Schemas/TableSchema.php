<?php


namespace BotFramework\Database\Schemas;


use Illuminate\Database\Capsule\Manager as Capsule;

abstract class TableSchema
{
	/**
	 * @var string
	 */
	protected $tableName;

	/**
	 * Create table with defined schema
	 *
	 * @return void
	 */
	abstract public function up ();

	/**
	 * Drop table
	 *
	 * @return $this
	 */
	public function down ()
	{
		Capsule::schema()->dropIfExists($this->tableName);
		return $this;
	}

	/**
	 * Create table only if not already there
	 *
	 * @return void
	 */
	public function createIfNotExists ()
	{
		if (! Capsule::schema()->hasTable($this->tableName))
			$this->up();
	}
}
