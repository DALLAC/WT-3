<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

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
        $appUrl = Config::get('app.url');

        if ($appUrl && $appUrl !== 'http://localhost') {
            URL::forceRootUrl($appUrl);
            URL::forceScheme('https');
        }

        
    }
}