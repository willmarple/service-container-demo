<?php

use App\Services\Stripe\Facades\Stripe;
use App\Models\User;
use App\Services\Stripe\StripeService;
use App\Testing\Services\Stripe\StripeTestService;
use App\Testing\Support\FixtureService;

beforeEach(function () {
    $fixtureService = app(FixtureService::class);
    $liveService = app(StripeService::class);
    app()->instance(StripeService::class, new StripeTestService($liveService));

    $customer = $fixtureService->getFixture('stripeCustomer', function () {
        $user = User::factory()->create();

        $customer = Stripe::client()->customers->create([
            'email' => $user->email,
            'name' => $user->name,
        ]);

        $user->update([
            'stripe_id' => $customer->id,
        ]);

        return $customer;
    });

    $paymentMethod = $fixtureService->getFixture('stripePaymentMethod', function () use ($customer) {
        $paymentMethod = Stripe::client()->paymentMethods->create([
            'type' => 'card',
            'card' => ['token' => 'tok_visa'],
            'billing_details' => [
                'email' => $customer['email'],
                'name' => $customer['name'],
            ],
        ]);

        return $paymentMethod;
    });


    $this->stripeCustomer = $customer;
    $this->stripePaymentMethod = $paymentMethod;

    $user = User::query()->where('stripe_id', $customer['id'])->firstOrFail();
    $this->actingAs($user);
});

it('confirms a setup intent', function () {
    /**
     * How can we call the route and interact with exactly as it
     * would be in a live setting, but instead of making a live
     * call to Stripe's API each time, use our FixtureService to
     * cache the response and return it on subsequent calls?
     *
     * Because we're resolving the StripeService from the container
     * in the controller, we can override the StripeService binding
     * as we do above in the beforeEach() hook.
     */
    $response = $this->postJson(route('stripe.setup-intent.create', [
        'payment_method_id' => $this->stripePaymentMethod['id'],
    ]));

    $response->assertStatus(200);

    $setupIntent = $response->json();

    expect($setupIntent)->toHaveKey('id');
    expect($setupIntent['object'])->toEqual('setup_intent');
    expect($setupIntent['status'])->toEqual('succeeded');
});
