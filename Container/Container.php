<?php


namespace Atmosphere\Container;


use Longman\TelegramBot\Entities\Chat;
use Longman\TelegramBot\Entities\User;
use Atmosphere\Gateway\Response;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Entities\Message;
use Atmosphere\Gateway\TelegramRequest;
use Longman\TelegramBot\Entities\CallbackQuery;
use BotFramework\Core\Supports\Traits\Singleton;

use function DI\autowire;

class Container
{
	use Singleton;

	/**
	 * @var \DI\Container
	 */
	private $container;

	/**
	 * Container constructor.
	 *
	 * @throws \Exception
	 */
	public function __construct ()
	{
		$builder = new \DI\ContainerBuilder();

		$builder->addDefinitions($this->definitions());

		$this->container = $builder->build();
	}

	/**
	 * Get an object from container
	 *
	 * @param $name
	 *
	 * @return mixed
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public static function get ($name)
	{
		if ($name == Update::class)
			return CurrentUpdate::get();

		return self::getInstance()->container->get($name);
	}

	/**
	 * Set specific key/object pair in container
	 *
	 * @param $name
	 * @param $args
	 */
	public static function set ($key, $object)
	{
		if ($key == Update::class)
			CurrentUpdate::set($object);
		else
			self::getInstance()->container->set($key, $object);
	}

	/**
	 * Container definitions
	 *
	 * @return array
	 */
	private function definitions ()
	{
		return [
			CallbackQuery::class => function ($container) {
				return self::get(Update::class)->getCallbackQuery();
			},

			Message::class => function ($container) {

				if (CurrentUpdate::isCallbackQuery())
					return self::get(CallbackQuery::class)->getMessage();

				return self::get(Update::class)->getMessage();
			},

			Chat::class => function ($container) {
				return $container->get(Message::class)->getChat();
			},

			User::class => function ($container) {
				return $container->get(Message::class)->getFrom();
			},

			TelegramRequest::class => function ($container) {
				return new TelegramRequest($container->get(Chat::class)->getId());
			},

			Response::class => autowire(),
		];
	}
}
