<?php


namespace BotFramework\Facilities;


class Response
{
	/**
	 * @var TelegramRequest
	 */
	private $telegramRequest;

	public function __construct ()
	{
		$this->telegramRequest = telegram();
	}

	/**
	 * make a reply to current message
	 *
	 * @return $this
	 */
	public function reply () : Response
	{
		$this->telegramRequest->reply(update()->getMessage()->getMessageId());
		return $this;
	}

	public function send ($view)
	{
		$this->telegramRequest->send(chat()->getId(), $view);
	}
}
