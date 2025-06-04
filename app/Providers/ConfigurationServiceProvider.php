<?php

namespace App\Providers;

use Clockwork\Support\Laravel\ClockworkMiddleware;
use Clockwork\Support\Laravel\ClockworkServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Livewire;
use Livewire\Features\SupportFileUploads\FilePreviewController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Auto Eager Loading
        if ($this->app->isLocal()) {
            $this->app->register(ClockworkServiceProvider::class);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(Kernel $kernel): void
    {
        // Auto Eager Loading
        Model::automaticallyEagerLoadRelationships();

        // Hide ClockWork on Production
        if ($this->app->isLocal()) {
            $kernel->prependMiddleware(ClockworkMiddleware::class);
        }

        $this->livewireConfig();

        $this->addTenantMiddlewareToExporterRoutes();
    }

    public function livewireConfig(): void
    {
        // Make Livewire 3 works with  Mcamara\LaravelLocalization
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle)
                ->middleware('web')
                ->prefix(LaravelLocalization::setLocale());
        });

        // Livewire 3 with multitenancy
        Livewire::setUpdateRoute(function ($handle) {
            return \Illuminate\Support\Facades\Route::post(
                '/livewire/update',
                $handle
            )->middleware(
                'web',
                'universal',
                InitializeTenancyByDomainOrSubdomain::class // or whatever tenancy middleware you use
            );
        });

        FilePreviewController::$middleware = [
            'web',
            'universal',
            InitializeTenancyByDomainOrSubdomain::class,
        ];
    }

    public function addTenantMiddlewareToExporterRoutes(): void
    {
        Event::listen(RouteMatched::class, function (RouteMatched $event) {
            $route = $event->route;

            if (
                $route->getName() === 'filament.exports.download' ||
                $route->getName() === 'filament.imports.failed-rows.download'
            ) {
                $route->middleware([
                    InitializeTenancyByDomainOrSubdomain::class,
                ]);
            }
        });
    }
}
