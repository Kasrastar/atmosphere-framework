<?php


namespace BotFramework\App\Views;


use BotFramework\Core\Exceptions\NotAViewClassException;

class ViewParser
{
	/**
	 * Parse views
	 *
	 * @param View|View[] $views
	 *
	 * @return array
	 */
	public static function parse ($views)
	{
		$views = is_array($views) ? $views : array($views);

		foreach ($views as $view)
		{
			self::validate($view);

			foreach ($view->render() as $render)
			{
				$renders[] = $render;
			}
		}

		return $renders;
	}

	private static function validate ($view)
	{
		if ( ! $view instanceof View)
			throw new NotAViewClassException($view);
	}
}
