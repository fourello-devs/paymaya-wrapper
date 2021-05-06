<?php

namespace FourelloDevs\PaymayaWrapper;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

/**
 * Class PaymayaWrapperServiceProvider
 * @package FourelloDevs\PaymayaWrapper
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class PaymayaWrapperServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'fourello-devs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'fourello-devs');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/paymayawrapper.php', 'paymayawrapper');

        // Register the service the package provides.
        $this->app->singleton('paymayawrapper', function ($app) {
            return new PaymayaWrapper;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['paymayawrapper'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/paymayawrapper.php' => config_path('paymayawrapper.php'),
        ], 'paymayawrapper.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/fourello-devs'),
        ], 'paymayawrapper.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/fourello-devs'),
        ], 'paymayawrapper.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/fourello-devs'),
        ], 'paymayawrapper.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
