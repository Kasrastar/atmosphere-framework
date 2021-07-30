<?php

namespace Tests\Stubs\App;

use Illuminate\Database\Schema\Blueprint;
use Atmosphere\Database\Schema\TableSchema;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserSchema extends TableSchema
{
	protected $tableName = 'users';
	
	public function up ()
	{
		Capsule::schema()->create($this->tableName, function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('current_route_id')->nullable();
			$table->integer('telegram_id');
			$table->string('username');
			$table->string('full_name');
			$table->timestamps();
			$table->foreign('current_route_id')->references('id')
				  ->on('current_routes');
		});
	}
}
