<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('dashboard')
            ->path('dashboard')
            ->databaseNotifications()
            ->sidebarWidth('md')
            ->login()
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()->defaultLocales([
                    'en',
                    'ar',
                ]),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(
                in: app_path('Filament/Dashboard/Resources'),
                for: 'App\\Filament\\Dashboard\\Resources'
            )
            ->discoverResources(
                in: app_path('Filament/Shared/Resources'),
                for: 'App\\Filament\\Shared\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Dashboard/Pages'),
                for: 'App\\Filament\\Dashboard\\Pages'
            )
            ->discoverPages(
                in: app_path('Filament/Shared/Pages'),
                for: 'App\\Filament\\Shared\\Pages'
            )
            ->pages([Pages\Dashboard::class])
            ->discoverWidgets(
                in: app_path('Filament/Dashboard/Widgets'),
                for: 'App\\Filament\\Dashboard\\Widgets'
            )
            ->widgets([Widgets\AccountWidget::class])
            ->viteTheme('resources/css/filament/dashboard/theme.css')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                'universal',
                InitializeTenancyByDomainOrSubdomain::class,
                // TODO: redirect users from central to dashboard
            ])
            ->authMiddleware([Authenticate::class]);
    }
}
