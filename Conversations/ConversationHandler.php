<?php


namespace Atmosphere\Conversations;


use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Model;
use Longman\TelegramBot\Entities\Update;
use Atmosphere\Models\Conversation as ConversationModel;

class ConversationHandler
{
	/**
	 * Start a new conversation
	 *
	 * @param Conversation $conversation
	 *
	 * @return void
	 */
	public static function startNewConversation (Conversation $conversation)
	{
		$conversation->onConversationStart();

		self::askNewQuestion($conversation, 0);

		ConversationModel::create([
			'user_id'    => user()->getId(),
			'class'      => get_class($conversation),
			'properties' => json_encode($conversation),
		]);
	}

	/**
	 * Get active conversation from database
	 *
	 * @return ConversationModel|Model
	 */
	public static function activeConversationInfo ()
	{
		$conversation_info = ConversationModel::query()->where([ 'user_id' => user()->getId() ])->first();

		if (empty($conversation_info))
			return null;

		return $conversation_info;
	}

	/**
	 * handle arrived answer and continue conversation
	 *
	 * @param Model  $conversation_info
	 * @param Update $update
	 *
	 * @return void
	 */
	public static function continueConversation (ConversationModel $conversation_info, Update $update)
	{
		$active_conversation = self::getConversation($conversation_info);

		if ($active_conversation->terminatingCondition($update))
			self::terminate($conversation_info, $active_conversation);

		$step = $conversation_info->step;

		$state = self::getAnswerForPreviousQuestion($active_conversation, $step, $update);
		self::nextStep($conversation_info, $active_conversation, $state, $step, $update);
	}

	/**
	 * Deserialize Conversation
	 *
	 * @param ConversationModel $conversation_info
	 *
	 * @return Conversation
	 */
	private static function getConversation (ConversationModel $conversation_info)
	{
		return new $conversation_info->class(json_decode($conversation_info->properties, true));
	}

	/**
	 * Continue conversation according to state
	 *
	 * @param ConversationModel $conversation_info
	 * @param Conversation      $active_conversation
	 * @param object|integer|null      $state
	 * @param integer           $step
	 * @param Update            $update
	 *
	 * @return void
	 * @throws UndefinedState
	 */
	private static function nextStep (ConversationModel $conversation_info,
		Conversation $active_conversation, $state, $step, Update $update)
	{
		if ($state == Conversation::Terminate || $state instanceof ConversationError)
			self::terminate($conversation_info, $active_conversation);

		else if ($state == Conversation::END)
			self::end($active_conversation, $update);

		else if (is_null($state))
		{
			self::askNewQuestion($active_conversation, $step);
			self::keepConversation($conversation_info, $active_conversation, ++$step);
		}

		else
			throw new UndefinedState($state);
	}

	/**
	 * Discover conversation methods with method name filtering
	 *
	 * @param Conversation $active_conversation
	 * @param string       $filter
	 *
	 * @return ReflectionMethod[]
	 */
	private static function discoverMethods (Conversation $active_conversation, $filter)
	{
		$reflection = new ReflectionClass($active_conversation);
		$methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

		$methods = array_filter($methods, function ($method, $index) use ($methods, $filter) {
			return string_starts_with($method->getName(), $filter);
		}, ARRAY_FILTER_USE_BOTH);

		return array_values($methods);
	}

	/**
	 * Call get... class method and return result
	 *
	 * @param Conversation $active_conversation
	 * @param integer      $target_method
	 * @param Update       $update
	 *
	 * @return mixed
	 * @throws \ReflectionException
	 */
	private static function getAnswerForPreviousQuestion (Conversation $active_conversation, $target_method,
		Update $update)
	{
		return self::discoverMethods($active_conversation, 'get')[ $target_method ]
			->invoke($active_conversation, $update);
	}

	/**
	 * Call ask... class method
	 *
	 * @param Conversation $active_conversation
	 * @param integer      $target_method
	 *
	 * @return void
	 * @throws \ReflectionException
	 */
	private static function askNewQuestion (Conversation $active_conversation, $target_method)
	{
		self::discoverMethods($active_conversation, 'ask')[ $target_method ]
			->invoke($active_conversation);
	}

	/**
	 * Serialize Conversation
	 *
	 * @param ConversationModel $conversation_info
	 * @param Conversation      $active_conversation
	 * @param integer           $step
	 *
	 * @return void
	 */
	private static function keepConversation (ConversationModel $conversation_info,
		Conversation $active_conversation, $step)
	{
		$conversation_info->step = $step;
		$conversation_info->properties = json_encode($active_conversation);
		$conversation_info->save();
	}

	/**
	 * Terminate active conversation immediately
	 *
	 * @param ConversationModel $conversation_info
	 * @param Conversation      $active_conversation
	 *
	 * @return void
	 */
	private static function terminate (ConversationModel $conversation_info,
		Conversation $active_conversation)
	{
		$active_conversation->onConversationTerminate();
		ConversationModel::destroy($conversation_info->id);
	}

	/**
	 * End active conversation
	 *
	 * @param Conversation $active_conversation
	 * @param Update       $update
	 *
	 * @return void
	 */
	private static function end (Conversation $active_conversation, Update $update)
	{
		$active_conversation->onConversationEnd($update);
	}
}
