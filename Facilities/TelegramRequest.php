<?php


namespace BotFramework\Facilities;


use BotFramework\Views\View;
use Longman\TelegramBot\Request;
use BotFramework\Views\DefaultView;
use BotFramework\Exceptions\NotAViewClassException;

class TelegramRequest
{
	/**
	 * Extra (Optional) Parameters Used by Telegram API
	 *
	 * @var array
	 */
	private $extraParameters = [];

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

	/**
	 * Send a text or a view to specific chat
	 *
	 * @param integer       $chat_id
	 * @param View | string $view
	 * @param array         $attributes
	 *
	 * @throws NotAViewClassException
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function send ($chat_id, $view)
	{
		$view = $this->validate($view);
		$renders = $view->render();

		foreach ($renders as $render)
		{
			$to_be_sent = [ 'chat_id' => $chat_id ] + $render + $this->extraParameters;

			$key = key($render);

			if ($key == 'text')
				Request::sendMessage($to_be_sent);

			else if ($key == 'photo')
				Request::sendPhoto($to_be_sent);

			else if ($key == 'video')
				Request::sendVideo($to_be_sent);

		}
	}

	/**
	 * Validate view or create new view if necessary
	 *
	 * @param string|View $view
	 *
	 * @return View
	 * @throws NotAViewClassException
	 */
	private function validate ($view)
	{
		if (is_string($view))
			return new DefaultView($view);

		else if ( ! $view instanceof View)
			throw new NotAViewClassException($view);

		else return $view;
	}
}
