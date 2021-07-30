<?php

namespace Atmosphere\Database\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
	/**
	 * Get table name of model
	 *
	 * @return string
	 */
	public static function getTableName ()
	{
		return ( new static )->getTable();
	}
}
