<?php

namespace App\Providers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
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
