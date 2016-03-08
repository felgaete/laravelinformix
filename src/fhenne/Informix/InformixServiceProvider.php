<?php namespace fhenne\Informix;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use fhenne\Informix\Queue\InformixConnector;
use Illuminate\Database\ConnectionResolver;

class InformixServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        Model::setConnectionResolver($this->app['db']);

        Model::setEventDispatcher($this->app['events']);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // Add database driver.
        $this->app->resolving('db', function ($db) {
            $db->extend('informix', function ($config) {
                return new Connection($config);
            });
        });

        // Add connector for queue support.
        $this->app->resolving('queue', function ($queue) {
            $queue->addConnector('informix', function () {
                return new InformixConnector($this->app['db']);
            });
        });    
    }
}
