<?php

namespace Atmosphere\View\Type;

use Longman\TelegramBot\Request;

class Photo extends Type
{
	public function __construct ($photo, $caption = null)
	{
		$photo = Request::encodeFile($photo);
		$this->render = compact('photo', 'caption');
	}
}
