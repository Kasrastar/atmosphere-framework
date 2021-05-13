<?php


namespace BotFramework\Core\Gateway;


use BotFramework\App\Views\View;

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
	public function __construct (TelegramRequest $telegram_request, $message_id)
	{
		$this->telegramRequest = $telegram_request;
		$this->messageID = $message_id;
	}

	/**
	 * make a reply to current message
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
	 */
	public function send ($message)
	{
		$this->telegramRequest->send($message);
	}

	/**
	 * Response on or multiple views
	 *
	 * @param View|View[] $views
	 *
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function view ($views)
	{
		$this->telegramRequest->view($views);
	}
}
