<?php

namespace Atmosphere\View\Type;

class VideoFromURL extends Type
{
	public function __construct ( $url, $caption = null, $duration = null, $thumb = null, $supports_streaming = false )
	{
		$video = $url;
		$this->render = compact('video', 'caption', 'duration', 'thumb', 'supports_streaming');
	}
}
