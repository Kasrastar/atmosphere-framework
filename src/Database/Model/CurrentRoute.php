<?php

namespace Atmosphere\Database\Model;

use App\Models\User;
use Atmosphere\Routing\RouteBuilder;

class CurrentRoute extends Model
{
	protected $guarded = [ 'id' ];
	
	public function setPathAttribute ($value)
	{
		$this->attributes['path'] = $value === '/' ? '/' : RouteBuilder::correctPath($value);
	}
	
	public function users ()
	{
		return $this->hasMany(User::class, 'current_route_id', 'id');
	}
}
