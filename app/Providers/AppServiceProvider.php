<?php

namespace App\Providers;

use Auth;
use Clockwork\Support\Laravel\ClockworkMiddleware;
use Clockwork\Support\Laravel\ClockworkServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Opcodes\LogViewer\Facades\LogViewer;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(ClockworkServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Kernel $kernel): void
    {
        if ($this->app->isLocal()) {
            $kernel->prependMiddleware(ClockworkMiddleware::class);
        }

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle)
                ->middleware('web')
                ->prefix(LaravelLocalization::setLocale());
        });
        Model::automaticallyEagerLoadRelationships();
        LogViewer::auth(function (Request $request) {
            if (
                ! in_array(
                    $request->getHost(),
                    config('tenancy.central_domains')
                )
            ) {
                return false;
            }

            return Auth::user()->hasRole('super_admin');
        });
    }
}
