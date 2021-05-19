<?php


namespace BotFramework\App\Scenarios;


use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Entities\CallbackQuery;

abstract class AbstractScenario
{
	/**
	 * Assigned sub scenarios
	 *
	 * @var array
	 */
	protected $subScenarios = [];

	/**
	 * Assigned conditions
	 *
	 * @var
	 */
	protected $conditions;

	/**
	 * @var Update|CallbackQuery
	 */
	protected $scenarioDependency;

	/**
	 * AbstractScenario constructor
	 *
	 * Inject scenario dependency
	 *
	 * @param Update|CallbackQuery $dependency
	 */
	public function __construct ($dependency)
	{
		$this->scenarioDependency = $dependency;
	}

	/**
	 * Run scenario if conditions are met and return true
	 *
	 * return false if not
	 *
	 * @return bool
	 */
	public function run ()
	{
		foreach ($this->conditions as $condition)
		{
			if (( new $condition )->check($this->scenarioDependency) == false)
				return false;
		}

		if (empty($this->subScenarios))
			$this->handle($this->scenarioDependency);

		else
			foreach ($this->subScenarios as $sub_scenario)
			{
				( new $sub_scenario )->handle($this->scenarioDependency);
			}

		return true;
	}
}
