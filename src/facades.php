<?php

use Illuminate\Foundation\Facade;

class Auth extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getName() { return 'auth'; }

}

class Blade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getName() { return 'blade'; }

}

class Cache extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getName() { return 'cache'; }

}

class DB extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getName() { return 'db'; }

}

class On extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getName() { return 'controllers'; }

}

class Session extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getName() { return 'session'; }

}

class Validator extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getName() { return 'validator'; }

}