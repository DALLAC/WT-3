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

               Gate::define('create-post', function (User $user) {
            // любой авторизованный
            return true;
        });

        Gate::define('update-post', function (User $user, Post $post) {
            return $user->id === $post->user_id || $user->is_admin;
        });

        Gate::define('delete-post', function (User $user, Post $post) {
            // обычный — только свои, админ — любые
            return $user->id === $post->user_id || $user->is_admin;
        });

        Gate::define('restore-post', function (User $user, Post $post) {
            // только админ
            return $user->is_admin;
        });

        Gate::define('force-delete-post', function (User $user, Post $post) {
            // только админ
            return $user->is_admin;
        });
    }
}