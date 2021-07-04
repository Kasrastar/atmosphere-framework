<?php


namespace Atmosphere\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
	/**
	 * Get table name of model
	 *
	 * @return string
	 */
	public static function getTableName ()
	{
		return (new static)->getTable();
	}

	/**
	 * Create a new row and return model
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
