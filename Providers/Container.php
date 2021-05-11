<?php


namespace BotFramework\Providers;


use BotFramework\Gateway\Response;
use BotFramework\Gateway\TelegramRequest;
use BotFramework\Facilities\Supports\Traits\Singleton;

use function DI\create;
use function DI\autowire;

class Container
{
	use Singleton;

	/**
	 * @var \DI\Container
	 */
	private $container;

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
		return self::getInstance()->container->get($name);
	}

	public static function set ($name, $arg)
	{
		self::getInstance()->container->set($name, $arg);
	}

	private function definitions ()
	{
		return [
			TelegramRequest::class => create()->constructor(chat()->getId()),
			Response::class        => autowire()->constructorParameter('message_id',
				message()->getMessageId()),
		];
	}
}
