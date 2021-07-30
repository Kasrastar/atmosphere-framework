<?php

namespace Atmosphere\Contract;

interface Kernel
{
	/**
	 * @return array
	 */
	public function middlewares ();
	
	/**
	 * @return string[]
	 */
	public function globalMiddlewares ();
	
	/**
	 * @return string[]
	 */
	public function schemas ();
	
	/**
	 * @return string[]
	 */
	public function serviceProviders ();
}
