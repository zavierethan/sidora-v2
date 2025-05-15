<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }

        // Redirect HTTP requests to HTTPS
        if (!$this->app->environment('local')) {
            $this->app['request']->server->set('HTTPS', true);
            $this->app['request']->server->set('HTTP_X_FORWARDED_PROTO', 'https');
        }
    }
}
