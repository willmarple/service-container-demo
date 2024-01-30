<?php

namespace App\Services\Stripe;

use App\Services\Concerns\Contracts\PaymentProcesor;
use Stripe\StripeClient;

class StripeService implements PaymentProcesor
{	protected StripeClient $stripe;

	public function __construct() {
		$this->stripe = new StripeClient( config( 'services.stripe.secret' ) );
	}

	public function client(): StripeClient {
		return $this->stripe;
	}
}
