<?php

namespace Atmosphere\Gateway;

class TelegramRequest
{
	/**
	 * RequestMaker
	 *
	 * @var \Atmosphere\Gateway\RequestMaker
	 */
	private $requestMaker;
	
	/**
	 * TelegramRequest constructor
	 *
	 * @param \Atmosphere\Gateway\RequestMaker $request_maker
	 */
	public function __construct (RequestMaker $request_maker)
	{
		$this->requestMaker = $request_maker;
	}
	
	/**
	 * Send simple text message to telegram
	 *
	 * @param string|int $chat_id
	 * @param string     $text
	 * @param array      $options
	 */
	public function sendMessage ($chat_id, $text, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'text'), $options);
	}
	
	/**
	 * Transport request to telegram
	 *
	 * @param string $method
	 * @param array  $required_parameters
	 * @param array  $optional_parameters
	 */
	private function callApi ($method, $required_parameters, $optional_parameters)
	{
		$this->requestMaker->callTelegramApi($method, array_merge($required_parameters, $optional_parameters));
	}
	
	public function sendPhoto ($chat_id, $photo, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'photo'), $options);
	}
	
	public function sendAudio ($chat_id, $audio, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'audio'), $options);
	}
	
	public function sendDocument ($chat_id, $document, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'document'), $options);
	}
	
	public function sendVideo ($chat_id, $video, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'video'), $options);
	}
	
	public function sendAnimation ($chat_id, $animation, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'animation'), $options);
	}
	
	public function sendVoice ($chat_id, $voice, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'voice'), $options);
	}
	
	public function sendVideoNote ($chat_id, $video_note, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'video_note'), $options);
	}
	
	public function sendMediaGroup ($chat_id, $media, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'media'), $options);
	}
	
	public function sendLocation ($chat_id, $latitude, $longitude, $options = [])
	{
		$this->callApi(__FUNCTION__, compact('chat_id', 'latitude', 'longitude'), $options);
	}
}
