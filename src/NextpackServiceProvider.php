<?php

namespace Nextpack\Nextpack;

use Illuminate\Support\ServiceProvider;

/**
 * Class NextpackServiceProvider.
 *
 * @category Service Provider
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class NextpackServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the package.
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Publish the Config file from the Package to the App directory
        |--------------------------------------------------------------------------
        */
        $this->configPublisher();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Implementation Bindings
        |--------------------------------------------------------------------------
        */
        $this->implementationBindings();

        /*
        |--------------------------------------------------------------------------
        | Facade Bindings
        |--------------------------------------------------------------------------
        */
        $this->facadeBindings();

        /*
        |--------------------------------------------------------------------------
        | Registering Service Providers
        |--------------------------------------------------------------------------
        */
        $this->serviceProviders();
    }

    /**
     * Implementation Bindings.
     */
    private function implementationBindings()
    {
        $this->app->bind(
            'Nextpack\Nextpack\Contracts\SayInterface',
            'Nextpack\Nextpack\Say'
        );
    }

    /**
     * Publish the Config file from the Package to the App directory.
     */
    private function configPublisher()
    {
        // When users execute Laravel's vendor:publish command, the config file will be copied to the specified location
        $this->publishes([
            __DIR__.'/Config/nextpack.php' => config_path('nextpack.php'),
        ]);
    }

    /**
     * Facades Binding.
     */
    private function facadeBindings()
    {
        // Register 'nextpack.say' instance container
        $this->app['nextpack.say'] = $this->app->share(function ($app) {
            return $app->make('Nextpack\Nextpack\Say');
        });

        // Register 'Say' Alias, So users don't have to add the Alias to the 'app/config/app.php'
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Nextpack', 'Nextpack\Nextpack\Facades\SayFacadeAccessor');
        });
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

    /**
     * Registering Other Custom Service Providers (if you have).
     */
    private function serviceProviders()
    {
        // $this->app->register('...\...\...');
    }
}
