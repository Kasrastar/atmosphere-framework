<?php

namespace Atmosphere\Keyboard;

use Longman\TelegramBot\Entities\LoginUrl;
use Longman\TelegramBot\Entities\Games\CallbackGame;

trait InlineKeyboardButton
{
	/**
	 * @param string       $text
	 * @param string       $callback_data
	 * @param string       $url
	 * @param LoginUrl     $login_url
	 * @param string       $switch_inline_query
	 * @param string       $switch_inline_query_current_chat
	 * @param CallbackGame $callback_game
	 * @param boolean      $pay
	 *
	 * @return array|void
	 */
	private function button ($text, $callback_data = null, $url = null, $login_url = null, $switch_inline_query = null,
							 $switch_inline_query_current_chat = null, $callback_game = null, $pay = null)
	{
		return compact('text', 'callback_data', 'url', 'login_url', 'switch_inline_query', 'switch_inline_query_current_chat', 'callback_game', 'pay');
	}
}
