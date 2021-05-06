<?php


namespace BotFramework\Facilities;


class Response
{
	private static $instance;

	/**
	 * Singleton
	 *
	 * @return Response
	 */
	public function getInstance () : Response
	{
		if (is_null(self::$instance))
			self::$instance = new Response;

		return self::$instance;
	}

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
