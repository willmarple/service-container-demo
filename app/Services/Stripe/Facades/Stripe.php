<?php

namespace App\Services\Stripe\Facades;

use App\Services\Stripe\StripeService;
use Illuminate\Support\Facades\Facade;

/**
 * Class Stripe
 * @package App\Services\Stripe\Facades
 *
 * @method static StripeClient client(): StripeClient
 *
 * @mixin StripeService
 * @see StripeService
 */

class Stripe extends Facade
{
    public static function getFacadeAccessor()
    {
        return StripeService::class;
    }
}
