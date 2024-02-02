<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette;


/**
 * Static class.
 */
trait StaticClass
{
	/**
	 * @return never
	 * @throws \Error
	 */
<<<<<<< HEAD
	final public function __construct()
=======
	private function __construct()
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
	{
		throw new \Error('Class ' . static::class . ' is static and cannot be instantiated.');
	}


	/**
	 * Call to undefined static method.
	 * @return void
	 * @throws MemberAccessException
	 */
	public static function __callStatic(string $name, array $args)
	{
		Utils\ObjectHelpers::strictStaticCall(static::class, $name);
	}
}
