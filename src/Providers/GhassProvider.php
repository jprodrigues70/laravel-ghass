<?php

namespace Ghass\Providers;

use Illuminate\Support\ServiceProvider;

class GhassProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/Ghass.php' => config_path('Ghass.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/Ghass.php', 'ghass');
    }
}
