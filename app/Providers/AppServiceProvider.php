<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('admin-only', fn($user) => $user->role === 'admin' || $user->role === 'developer');
        Gate::define('developer-only', fn($user) => $user->role === 'developer');
    }
}
