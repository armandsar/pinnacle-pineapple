<?php

namespace Armandsar\PinnaclePineapple;

use Illuminate\Support\ServiceProvider;

class PinnaclePineappleServiceProvider extends ServiceProvider
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
        $configPath = __DIR__ . '/../config/pinnacle_pineapple.php';

        $this->publishes([
            $configPath => config_path('pinnacle_pineapple.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/pinnacle_pineapple.php';
        $this->mergeConfigFrom($configPath, 'pinnacle_pineapple');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}