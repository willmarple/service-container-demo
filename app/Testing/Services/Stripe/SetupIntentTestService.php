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
        return app(FixtureService::class)->getFixture('stripeSetupIntent', function () use ($params) {
            return $this->client->setupIntents->create($params);
        });
    }
}
