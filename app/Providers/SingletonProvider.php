<?php

namespace App\Providers;

use App\Services\Currency\CurrencyService;
use App\Services\Tenants\CreateTenantService;
use Illuminate\Support\ServiceProvider;

class SingletonProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CreateTenantService::class);
        $this->app->singleton(CurrencyService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
