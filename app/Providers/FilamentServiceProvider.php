<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn () => view('partials.head'),
        );
    }
}
