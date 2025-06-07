<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('yandex_direct.campaigns.additional-settings', \App\View\Components\YandexDirect\Campaigns\AdditionalSettings::class);
        Blade::component('yandex_direct.campaigns.restrictions', \App\View\Components\YandexDirect\Campaigns\Restrictions::class);
        Blade::component('yandex_direct.campaigns.sidebar', \App\View\Components\YandexDirect\Campaigns\Sidebar::class);
    }
}
