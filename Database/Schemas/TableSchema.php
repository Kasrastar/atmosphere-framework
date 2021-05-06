<?php


namespace BotFramework\Database\Schemas;


use Illuminate\Database\Capsule\Manager as Capsule;

class   TableSchema
{
	protected $tableName;

	public function up () { }

	public function down ()
	{
		Capsule::schema()->dropIfExists($this->tableName);
		return $this;
	}
}