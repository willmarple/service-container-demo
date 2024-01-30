<?php

namespace App\Providers;

use App\Services\Concerns\Contracts\PaymentProcesor;
use App\Services\Concerns\Enums\ProcessorTypesEnum;
use App\Services\Paypal\PayPalService;
use App\Services\Stripe\StripeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerPaymentResolver();
        $this->registerStripeService();
        $this->registerPayPalService();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerStripeService()
    {
        $this->app->singleton(StripeService::class, fn () => new StripeService());
    }

    private function registerPayPalService()
    {
        $this->app->singleton(PayPalService::class, fn () => new PayPalService());
    }

    private function registerPaymentResolver()
    {
        $this->app->bind(PaymentProcesor::class, function ($app) {
            $processor = ProcessorTypesEnum::tryFrom(auth()->user()?->processor);

            return match ($processor) {
                ProcessorTypesEnum::Stripe => $app->make(StripeService::class),
                ProcessorTypesEnum::PayPal => $app->make(PayPalService::class),
                default => throw new \Exception('Invalid payment processor'),
            };
        });
    }
}
