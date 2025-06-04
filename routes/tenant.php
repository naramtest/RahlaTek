<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\InvoiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Stancl\Tenancy\Features\UserImpersonation;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'web',
            InitializeTenancyByDomainOrSubdomain::class,
            PreventAccessFromCentralDomains::class,
        ],
    ],
    function () {
        Route::get('/', function () {
            return view('pages.admin.home');
        });

        Route::get('/impersonate/{token}', function ($token) {
            return UserImpersonation::makeResponse($token);
        });

        Route::controller(InvoiceController::class)->group(function () {
            Route::get('/payments/invoice', 'downloadInvoice')
                ->name('payment.invoice')
                ->middleware('signed');

            Route::middleware(['auth'])->group(function () {
                Route::get(
                    '/admin/payment/{payment}/invoice/preview',
                    'previewInvoice'
                )->name('admin.payment.invoice.preview');

                Route::get(
                    '/admin/payment/{payment}/invoice/download',
                    'downloadInvoice'
                )->name('admin.payment.invoice.download');
            });
        });
    }
);
