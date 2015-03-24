<?php namespace CristianJaramillo\Basic;

use Illuminate\Support\ServiceProvider;
use CristianJaramillo\Basic\Console\DBCreatorCommand;


class BasicServiceProvider extends ServiceProvider
{
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

        $this->package('cristianjaramillo/basic');

	}

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        foreach (['Db'] as $command) {
            $this->{"register$command"}();
        }

        $this->commands('basic.db');

    }

    public function registerDB()
    {
        $this->app['basic.db'] = $this->app->share(function($app){
            return new DBCreatorCommand();
        });
    }

	/**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}