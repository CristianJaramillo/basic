<?php namespace CristianJaramillo\Basic;

/**
 *
 */
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
	    $this->loadViewsFrom(__DIR__.'/Views', 'basic');

    	$routeConfig = [
            'namespace' => 'CristianJaramillo\Basic\Controllers',
        ];
        
        $this->app['router']->group($routeConfig, function($router) {
            $router->get('basic', [
                'uses' => 'BasicController@index',
                'as' => 'cristianjaramillo.basic.index',
            ]);
        });

	}

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
    }

	/**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('basic');
    }

}