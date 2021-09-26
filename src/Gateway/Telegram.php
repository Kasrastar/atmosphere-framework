<?php

namespace Atmosphere\Gateway;

use Atmosphere\Keyboard\KeyboardMarkup;

/**
 * Class Telegram
 *
 * @method self sendMessage($text)
 */
class Telegram
{
	/**
	 * Extra (Optional) Parameters Used by Telegram Request API
	 *
	 * @var array
	 */
	private $extraParameters = [];

	/**
	 * @var int
	 */
	private $chatID;

	/**
	 * @var TelegramRequest
	 */
	private $telegram_request;

	/**
	 * TelegramRequest constructor.
	 *
	 * @param TelegramRequest $telegram_request
	 * @param string|int      $chat_id
	 */
	public function __construct ( TelegramRequest $telegram_request, $chat_id )
	{
		$this->chatID = $chat_id;
		$this->telegram_request = $telegram_request;
	}

	/**
	 * @param $name
	 * @param $arguments
	 *
	 * @return Telegram
	 */
	public function __call ( $name, $arguments )
	{
		$arguments = array_merge($arguments, [ $this->extraParameters ]);
		$this->telegram_request->$name($this->chatID, ...$arguments);
		return $this->flush();
	}

	/**
	 * Disable notification
	 *
	 * @return $this
	 */
	public function silent ()
	{
		$this->extraParameters['disable_notification'] = true;
		return $this;
	}

	/**
	 * Send keyboard
	 *
	 * @param KeyboardMarkup $keyboard
	 *
	 * @return $this
	 */
	public function withKeyboard ( KeyboardMarkup $keyboard )
	{
		$this->extraParameters['reply_markup'] = json_encode($keyboard->render());
		return $this;
	}

	/**
	 * Remove keyboard
	 *
	 * @return $this
	 */
	public function withoutKeyboard ()
	{
		$this->extraParameters['reply_markup'] = [ 'remove_keyboard' => true ];
		return $this;
	}

	/**
	 * Make a reply to specific message
	 *
	 * @return $this
	 */
	public function replyTo ( $message_id )
	{
		$this->extraParameters['reply_to_message_id'] = $message_id;
		return $this;
	}

	/**
	 * Clear extra parameters
	 *
	 * @return $this
	 */
	private function flush ()
	{
		$this->extraParameters = [];
		return $this;
	}
}
