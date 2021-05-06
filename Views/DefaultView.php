<?php


namespace BotFramework\Views;


class DefaultView extends View
{
	private $text;

	public function __construct ($text)
	{
		$this->text = $text;
	}

	protected function template (ViewBuilder $builder)
	{
		$builder->text(function () use ($builder) {
			return [
				$builder->string($this->text)
			];
		});
	}
}
