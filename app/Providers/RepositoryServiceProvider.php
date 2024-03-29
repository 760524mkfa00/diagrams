<?php namespace Plans\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('Plans\Repositories\User\UserRepository', 'Plans\Repositories\User\DbUserRepository');
		$this->app->bind('Plans\Repositories\Floor\FloorRepository', 'Plans\Repositories\Floor\DbFloorRepository');
		$this->app->bind('Plans\Repositories\Type\TypeRepository', 'Plans\Repositories\Type\DbTypeRepository');
	}

}
