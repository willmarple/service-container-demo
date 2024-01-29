<?php

namespace App\Testing\Services\Stripe;

use App\Testing\Support\FixtureService;
use Stripe\StripeClient;

class SetupIntentTestService
{
    public function __construct(public StripeClient $client)
    {
    }

    public function create(array $params)
    {
        ray('MAKING TEST SETUP INTENT REQUEST', $params);
        return app(FixtureService::class)->getFixture('stripeSetupIntent', function () use ($params) {
            ray('MAKING LIVE SETUP INTENT REQUEST');
            return $this->client->setupIntents->create($params);
        });
    }
}
