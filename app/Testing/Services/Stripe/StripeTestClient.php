<?php

namespace App\Testing\Services\Stripe;

use App\Services\Stripe\StripeService;

class StripeTestClient
{
    protected $serviceMap = [
        'setupIntents' => SetupIntentTestService::class,
    ];

    public function __construct(
        public StripeService $service,
    ) {
    }

    public function __get($name)
    {
        if (isset($this->serviceMap[$name])) {
            return new $this->serviceMap[$name]($this->service->client());
        }

        return $this->service->client()->$name;
    }
}
