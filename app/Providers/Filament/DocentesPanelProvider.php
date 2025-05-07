<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Support\Assets\Css;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DocentesPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('docentes')
            ->path('docentes')
            ->authGuard('docente')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->favicon('https://upload.wikimedia.org/wikipedia/commons/4/4c/Escudo-ucv.png') // Ícono de la UCV
            ->discoverResources(in: app_path('Filament/Docentes/Resources'), for: 'App\\Filament\\Docentes\\Resources')
            ->discoverPages(in: app_path('Filament/Docentes/Pages'), for: 'App\\Filament\\Docentes\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                 //Widgets\FilamentInfoWidget::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Docentes/Widgets'), for: 'App\\Filament\\Docentes\\Widgets')
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

            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
