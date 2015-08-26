<?php

namespace Jarboe\Component\Logs;


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
        include __DIR__ .'/Http/routes.php';
    } // end boot
    

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ .'/config/logs.php', 'jarboe.c.logs'
        );
    } // end register
    

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            //
        );
    }

}