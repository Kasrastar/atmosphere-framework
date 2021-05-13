<?php


namespace BotFramework\Core\Gateway;


use BotFramework\App\Views\View;
use BotFramework\Application;
use Longman\TelegramBot\Request;
use BotFramework\App\Views\ViewParser;
use BotFramework\App\Views\DefaultView;
use BotFramework\Core\Exceptions\NotAViewClassException;

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
	 * make a reply to current message
	 *
	 * @return $this
	 */
	public function reply ($message_id) : TelegramRequest
	{
		$this->extraParameters['reply_to_message_id'] = $message_id;
		return $this;
	}

	public function send ($message)
	{
		$this->view(new DefaultView($message));
	}

	/**
	 * Send one or multiple views
	 *
	 * @param View|View[] $views
	 *
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function view ($views)
	{
		$this->validateViews($views);
		$messages = ViewParser::parse($views);
		$this->callApi($messages);
	}

	/**
	 * Send a text or a view to specific chat
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

		}
	}

	/**
	 * @param $views
	 *
	 * @throws NotAViewClassException
	 */
	private function validateViews ($views)
	{
		$views = is_array($views) ? $views : [$views];

		foreach ($views as $view)
			if (!$view instanceof View)
				throw new NotAViewClassException($view);
	}

	/**
	 * Check Application mode
	 *
	 * @return bool
	 */
	private function isInTestingMode ()
	{
		return Application::getMode() == Application::TESTING_MODE;
	}
}