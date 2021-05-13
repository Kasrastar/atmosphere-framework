<?php


namespace BotFramework\App\Scenarios;


use Longman\TelegramBot\Entities\Update;


abstract class Scenario
{
	protected $subScenarios = [];
	protected $conditions;
	private $update;

	public function __construct (Update $update)
	{
		$this->update = $update;
	}

	final public function run () : bool
	{
		foreach ($this->conditions as $condition)
		{
			if ((new $condition($this->update))->check($this->update) == false)
				return false;
		}

		if (empty($this->subScenarios))
		{
			$this->handle($this->update);
		}
		else
		{
			foreach ($this->subScenarios as $sub_scenario)
			{
				new $sub_scenario($this->update);
			}
		}

		return true;
	}

	abstract protected function handle (Update $update);
}
