<?php


namespace BotFramework\Database\Schemas;


use Illuminate\Database\Capsule\Manager as Capsule;

class TableSchema
{
	protected $tableName;

	/**
	 * Force database to create table
	 */
	public function up () { }

	/**
	 * Create table only if not already there
	 */
	public function createIfNotExists ()
	{
		if (! Capsule::schema()->hasTable($this->tableName))
			$this->up();
	}

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
}
