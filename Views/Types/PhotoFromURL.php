<?php


namespace Atmosphere\Views\Types;


class PhotoFromURL extends Type
{
	public function __construct ($url, $caption = null)
	{
		$photo = $url;
		$this->render = compact('photo', 'caption');
	}
}