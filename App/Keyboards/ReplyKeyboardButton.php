<?php


namespace BotFramework\App\Keyboards;


use Longman\TelegramBot\Entities\KeyboardButtonPollType;

trait ReplyKeyboardButton
{
	/**
	 * @param string                 $text
	 * @param boolean                $request_contact
	 * @param boolean                $request_location
	 * @param KeyboardButtonPollType $request_poll
	 *
	 * @return array|void
	 */
	private function button ($text, $request_contact = null, $request_location = null, $request_poll = null)
	{
		return array_filter(compact('text', 'request_contact', 'request_location', 'request_poll'));
	}
}
