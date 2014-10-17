<?php namespace Fuller\LaravelConfigurator;

use Illuminate\Support\ServiceProvider;

class LaravelConfiguratorServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('fuller/laravel-configurator');
        $this->app->make('configurator');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{



		$this->app->bindShared('configurator', function($app){
             $configurator = new Configurator($app['config']);
             return $configurator->load()->apply();
        });

		 // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Configure', 'Fuller\LaravelConfigurator\Facades\Configure');
        });
    }

}
