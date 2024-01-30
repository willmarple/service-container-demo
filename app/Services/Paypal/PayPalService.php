<?php

namespace App\Services\Paypal;

use App\Services\Concerns\Contracts\PaymentProcesor;

class PayPalService implements PaymentProcesor
{
    public function client()
    {
        // PayPal SDK client
    }
}
