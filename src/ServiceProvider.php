<?php namespace CristianJaramillo\Basic;

use CristianJaramillo\Basic\Console\CreatorDBCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
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
        foreach (['CreatorDB'] as $command) {
            $this->{"register$command"}();
        }
    }

    public function registerCreatorDB()
    {
        $this->app['create.db'] = $this->app->share(function($app){
            return new CreatorDBCommand();
        });
    
        $this->commands('create.db');        
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