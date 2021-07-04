<?php


namespace Atmosphere\Views\Types;


use Longman\TelegramBot\Request;

class Video extends Type
{
	public function __construct ($video, $caption = null, $duration = null, $thumb = null, $supports_streaming = false)
	{
		$video = Request::encodeFile($video);
		$this->render = compact('video', 'caption', 'supports_streaming', 'duration', 'thumb');
	}
}