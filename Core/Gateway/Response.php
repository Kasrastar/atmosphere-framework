<?php


namespace BotFramework\Core\Gateway;


use BotFramework\App\Views\View;
use Longman\TelegramBot\Entities\Message;
use BotFramework\App\Keyboards\KeyboardMarkup;

class Response
{
	/**
	 * @var TelegramRequest
	 */
	private $telegramRequest;

	/**
	 * @var integer
	 */
	private $messageID;

	/**
	 * Response constructor.
	 *
	 * @param TelegramRequest $telegram_request
	 * @param integer         $message_id
	 */
	public function __construct (TelegramRequest $telegram_request, Message $message)
	{
		$this->telegramRequest = $telegram_request;
		$this->messageID = $message->getMessageId();
	}

	/**
	 * Disable notification
	 *
	 * @return $this
	 */
	public function silent ()
	{
		$this->telegramRequest->silent();
		return $this;
	}

	/**
	 * Send keyboard
	 *
	 * @param KeyboardMarkup $keyboard
	 *
	 * @return $this
	 */
	public function keyboard (KeyboardMarkup $keyboard)
	{
		$this->telegramRequest->keyboard($keyboard);
		return $this;
	}

	/**
	 * Remove keyboard
	 *
	 * @return Response
	 */
	public function removeKeyboard ()
	{
		$this->telegramRequest->removeKeyboard();
		return $this;
	}

	/**
	 * make reply to current message
	 *
	 * @return $this
	 */
	public function reply () : Response
	{
		$this->telegramRequest->reply($this->messageID);
		return $this;
	}

	/**
	 * Send simple text message
	 *
	 * @param string $message
	 *
	 * @return void
	 */
	public function send ($message = '')
	{
		$this->telegramRequest->send($message);
	}

	/**
	 * Response on or multiple views
	 *
	 * @param View|View[] $views
	 *
	 * @return void
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function view ($views)
	{
		$this->telegramRequest->view($views);
	}
}
