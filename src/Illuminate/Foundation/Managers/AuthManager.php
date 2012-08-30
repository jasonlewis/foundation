<?php namespace Illuminate\Managers;

use Illuminate\Auth\Guard;
use Illuminate\Auth\DatabaseUserProvider;
use Illuminate\Auth\EloquentUserProvider;

class AuthManager extends Manager {

	/**
	 * Create a new driver instance.
	 *
	 * @param  string  $driver
	 * @return mixed
	 */
	protected function createDriver($driver)
	{
		$guard = parent::createDriver($driver);

		// When using the remember me functionality of the authentication services we
		// will need to be set the encryption isntance of the guard, which allows
		// secure, encrypted cookie values to get generated for those cookies.
		$guard->setEncrypter($this->app['encrypter']);

		$guard->setCookieCreator($this->app['cookie']);

		return $guard;
	}

	/**
	 * Create an instance of the database driver.
	 *
	 * @return Illuminate\Auth\Guard
	 */
	protected function createDatabaseDriver()
	{
		$provider = $this->createDatabaseProvider();

		return new Guard($provider, $this->app['session'], $this->app['request']);
	}

	/**
	 * Create an instance of the database user provider.
	 *
	 * @return Illuminate\Auth\DatabaseUserProvider
	 */
	protected function createDatabaseProvider()
	{
		$connection = $this->app['db']->connection();

		// When using the basic database user provider, we need to inject the table we
		// want to use, since this is not an Eloquent model we will have no way to
		// know without telling the provider, so we'll inject the config value.
		$table = $this->app['config']['auth.table'];

		return new DatabaseUserProvider($connection, $this->app['hash'], $table);
	}

	/**
	 * Create an instance of the Eloquent driver.
	 *
	 * @return Illuminate\Auth\Guard
	 */
	public function createEloquentDriver()
	{
		$provider = $this->createEloquentProvider();

		return new Guard($provider, $this->app['session'], $this->app['request']);
	}

	/**
	 * Create an instance of the Eloquent user provider.
	 *
	 * @return Illuminate\Auth\EloquentUserProvider
	 */
	protected function createEloquentProvider()
	{
		$table = $this->app['config']['auth.model'];

		return new EloquentUserProvider($this->app['hash'], $model);
	}

	/**
	 * Get the default authentication driver name.
	 *
	 * @return string
	 */
	protected function getDefaultDriver()
	{
		return $this->app['config']['auth.driver'];
	}

}