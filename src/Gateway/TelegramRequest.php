<?php


namespace Atmosphere\Gateway;


use Longman\TelegramBot\Request;

class TelegramRequest
{
	/**
	 * Extra (Optional) Parameters Used by Telegram API
	 *
	 * @var array
	 */
	private $extraParameters = [];

	/**
	 * @var integer
	 */
	private $chatID;

	/**
	 * TelegramRequest constructor.
	 *
	 * @param integer $chat_id
	 */
	public function __construct ($chat_id)
	{
		$this->chatID = $chat_id;
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
	 * @param \Atmosphere\Keyboards\KeyboardMarkup $keyboard
	 *
	 * @return $this
	 */
	public function keyboard (\Atmosphere\Keyboards\KeyboardMarkup $keyboard)
	{
		$this->extraParameters['reply_markup'] = $keyboard->render();
		return $this;
	}

	/**
	 * Remove keyboard
	 *
	 * @return $this
	 */
	public function removeKeyboard ()
	{
		$this->extraParameters['reply_markup'] = ['remove_keyboard' =>  true];
		return $this;
	}

	/**
	 * make reply to current message
	 *
	 * @return $this
	 */
	public function reply ($message_id)
	{
		$this->extraParameters['reply_to_message_id'] = $message_id;
		return $this;
	}

	/**
	 * Send simple text
	 *
	 * @param string $message
	 *
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function send ($message)
	{
		$this->view(new \Atmosphere\Views\DefaultView(['text' => $message]));
	}

	/**
	 * Send one or multiple views
	 *
	 * @param \Atmosphere\Views\View|\Atmosphere\Views\View[] $views
	 *
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function view ($views)
	{
		$messages = \Atmosphere\Views\ViewParser::parse($views);
		$this->callApi($messages);
	}

	/**
	 * Send messages to specific chat
	 *
	 * @param array $messages
	 *
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	private function callApi ($messages)
	{
		// prevent method from calling telegram api
		if ($this->isInTestingMode())
			return;

		foreach ($messages as $message)
		{
			$to_be_sent = [ 'chat_id' => $this->chatID ] + $message + $this->extraParameters;

			$type = key($message);

			if ($type == 'text')
				Request::sendMessage($to_be_sent);

			else if ($type == 'photo')
				Request::sendPhoto($to_be_sent);

			else if ($type == 'video')
				Request::sendVideo($to_be_sent);

			else if ($type == 'emoji')
				Request::sendDice($to_be_sent);
		}
	}

	/**
	 * Check Application mode
	 *
	 * @return bool
	 */
	private function isInTestingMode ()
	{
		return \Atmosphere\Application::getMode() == \Atmosphere\Application::TESTING_MODE;
	}
}
