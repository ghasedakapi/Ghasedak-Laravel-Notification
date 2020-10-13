<?php

namespace Ghasedak\LaravelNotification;

use Illuminate\Support\ServiceProvider;

class GhasedakNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(GhasedakChannel::class)
            ->needs(GhasedakApi::class)
            ->give(function () {
                return new GhasedakApi(config('services.Ghasedak.api_key'));
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
