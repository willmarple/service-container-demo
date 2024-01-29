<?php

namespace App\Providers;

use App\Services\Stripe\StripeService;
use App\Testing\Services\Stripe\StripeTestService;
use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(StripeService::class, fn () => new StripeService());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
