<?php


namespace Atmosphere\Database\Schemas;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class ConversationSchema extends TableSchema
{
	protected $tableName = 'conversations';

	/**
	 * Conversation Scheme
	 *
	 * @return void
	 */
	public function up ()
	{
		Capsule::schema()->create($this->tableName, function (Blueprint $table) {
			$table->id();

			$table->unsignedInteger('user_id')->unique();
			$table->unsignedInteger('step')->default(0);
			$table->string('class');
			$table->json('properties');

			$table->timestamps();
		});
	}
}
