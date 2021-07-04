<?php


namespace Atmosphere\Views\Types;


class VideoFromURL extends Type
{
	public function __construct ($url, $caption = null, $duration = null, $thumb = null, $supports_streaming = false)
	{
		$video = $url;
		$this->render = compact('video', 'duration', 'thumb', 'caption');
	}
}