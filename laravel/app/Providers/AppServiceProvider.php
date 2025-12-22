<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;  
use App\Models\User;                  
use App\Models\Studio;                


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
        Gate::define('create-studio', function (User $user) {
            // Любой авторизованный пользователь может создавать студии
            return true;
        });
        
        Gate::define('update-studio', function (User $user, Studio $studio) {
            return $user->is_admin || $studio->user_id === $user->id;
        });

        Gate::define('delete-studio', function (User $user, Studio $studio) {
            return $user->is_admin || $studio->user_id === $user->id;
        });

        Gate::define('restore-studio', function (User $user, Studio $studio) {
            return (bool) $user->is_admin;
        });

        Gate::define('force-delete-studio', function (User $user, Studio $studio) {
            return (bool) $user->is_admin;
        });
        $appUrl = Config::get('app.url');

        if ($appUrl && $appUrl !== 'http://localhost') {
            URL::forceRootUrl($appUrl);
            URL::forceScheme('https');
        }

        
    }
}