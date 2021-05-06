<?php


namespace BotFramework\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
	/**
	 * Save a new model and return the instance.
	 *
	 * @param array $attributes
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|EloquentModel
	 */
	public static function create ($attributes)
	{
		return self::query()->create($attributes);
	}
}
