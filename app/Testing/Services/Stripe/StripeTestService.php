<?php

namespace App\Testing\Services\Stripe;

use App\Services\Stripe\StripeService;

class StripeTestService
{
    public function __construct(public StripeService $stripeService)
    {
    }

    public function client()
    {
        ray('USING TEST STRIPE CLIENT');
        return new StripeTestClient($this->stripeService);
    }
}
