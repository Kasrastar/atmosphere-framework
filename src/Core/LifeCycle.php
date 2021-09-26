<?php

namespace Atmosphere\Core;

use Atmosphere\Routing\Router;
use Longman\TelegramBot\Entities\Update;
use Atmosphere\Database\Repository\UserRepository;

class LifeCycle
{
	/**
	 * @var string[]
	 */
	private $globalMiddlewares;

	/**
	 * @var Router
	 */
	private $router;

	/**
	 * @var UserRepository
	 */
	private $user_repository;

	/**
	 * LifeCycle constructor.
	 *
	 * @param Application    $application
	 * @param Router         $router
	 * @param UserRepository $user_repository
	 */
	public function __construct ( Application $application, Router $router, UserRepository $user_repository )
	{
		$this->globalMiddlewares = $application->getGlobalMiddlewares();
		$this->router = $router;
		$this->user_repository = $user_repository;
	}

	/**
	 * Take received updates into lifecycle
	 *
	 * @param Update[] $updates
	 */
	public function takeInto ( $updates )
	{
		foreach ( $updates as $update )
		{
			app()->instance(Update::class, $update);

			if ( !$this->passGlobalMiddlewares() )
			{
				continue;
			}

			// TODO try to follow conversation steps

			$user = $update->getMessage()->getFrom();
			$this->user_repository->registerUserIfNotExists(
				$user->getId(),
				$user->getUsername(),
				$user->getFirstName() . $user->getLastName()
			);

			$this->router->route($update);
		}
	}

	private function passGlobalMiddlewares ()
	{
		foreach ( $this->globalMiddlewares as $middleware )
		{
			if ( !app()->call([ $middleware, 'allow' ]) )
			{
				return false;
			}
		}

		return true;
	}

	// /**
	//  * @param Update $update
	//  *
	//  * @return bool
	//  */
	// private function tryToFollowConversationSteps (Update $update)
	// {
	// 	$conversation_info = ConversationHandler::activeConversationInfo();
	//
	// 	if ( is_null($conversation_info) )
	// 		return false;
	//
	// 	ConversationHandler::continueConversation($conversation_info, $update);
	//
	// 	return true;
	// }
}
