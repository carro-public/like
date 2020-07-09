<?php

namespace CarroPublic\Like;

use Illuminate\Support\ServiceProvider;

class LikeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/like.php', 'like');

        // Register the service the package provides.
        $this->app->singleton('like', function ($app) {
            return new Like;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['like'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/like.php' => config_path('like.php'),
        ], 'like.config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_likes_table.php.stub' =>
                database_path('migrations/'.date('Y_m_d_His', time()).'_create_likes_table.php'),
        ], 'migrations');
    }
}
