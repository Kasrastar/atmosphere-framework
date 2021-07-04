<?php


namespace Atmosphere\Views;


class ViewParser
{
	/**
	 * Parse views and prepare raw data to send
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

	/**
	 * @param $view
	 *
	 * @throws NotAViewClassException
	 */
	private static function validate ($view)
	{
		if ( ! $view instanceof View)
			throw new NotAViewClassException($view);
	}
}
