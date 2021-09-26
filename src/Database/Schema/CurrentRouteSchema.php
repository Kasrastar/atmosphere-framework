<?php

namespace Atmosphere\Database\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CurrentRouteSchema extends TableSchema
{
	protected $tableName = 'current_routes';

	public function up ()
	{
		Capsule::schema()->create($this->tableName, function ( Blueprint $table ) {
			$table->id();
			$table->string('path');
			$table->boolean('call_event');
			$table->timestamps();
		});
	}
}
