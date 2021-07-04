<?php


namespace Atmosphere\Gateway;


use Longman\TelegramBot\Entities\Message;

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
	 * @param \Atmosphere\Keyboards\KeyboardMarkup $keyboard
	 *
	 * @return $this
	 */
	public function keyboard (\Atmosphere\Keyboards\KeyboardMarkup $keyboard)
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
	 * @param \Atmosphere\Views\View|\Atmosphere\Views\View[] $views
	 *
	 * @return void
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function view ($views)
	{
		$this->telegramRequest->view($views);
	}

	/**
	 * Start a new conversation for this user
	 *
	 * @param \Atmosphere\Conversations\Conversation $conversation
	 */
	public function conversation (\Atmosphere\Conversations\Conversation $conversation)
	{
		\Atmosphere\Conversations\ConversationHandler::startNewConversation($conversation);
	}
}
