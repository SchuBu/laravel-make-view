<?php

namespace SchuBu\MakeView;

use Illuminate\Support\ServiceProvider;
use SchuBu\MakeView\Console\MakeViewCommand;
use SchuBu\MakeView\Console\MakeModelCommand;

class MakeViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'make-view');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'make-view');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('make-view.php'),
            ], 'config');

            if ($this->app->runningInConsole()) {
                // publish config file

                $this->commands([
                    MakeViewCommand::class,
//                    MakeModelCommand::class,
                ]);
            }

            $this->publishes([
                __DIR__ . '/Console/stubs' =>  app_path('Vendor'. DIRECTORY_SEPARATOR .'SchuBu'. DIRECTORY_SEPARATOR .'make-view' . DIRECTORY_SEPARATOR . 'stubs'),
            ], 'stubs');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/make-view'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/make-view'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/make-view'),
            ], 'lang');*/

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'make-view');

        // Register the main class to use with the facade
        $this->app->singleton('make-view', function () {
            return new MakeView;
        });
    }
}
