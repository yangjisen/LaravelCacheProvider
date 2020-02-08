<?php

namespace YangJiSen\CacheUserProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config.php','cache-user');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        Auth::provider('cache',function($app, $config) {
            $config['model']::observe(UserObserver::class);
            return new CacheUserProvider(
                $app['hash'],
                $config['model'],
                config('cache-user.cache_ttl', 3600)
            );
        });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('cache-user.php'),
        ], 'cache-user');
    }
}
