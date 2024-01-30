<?php

namespace App\Services\Concerns\Enums;

enum ProcessorTypesEnum: string
{
    case Stripe = 'stripe';
    case PayPal = 'paypal';
}
