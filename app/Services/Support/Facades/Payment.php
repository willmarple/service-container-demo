<?php

namespace App\Services\Support\Facades;

use App\Services\Concerns\Contracts\PaymentProcesor;
use Illuminate\Support\Facades\Facade;

class Payment extends Facade
{
    public static function getFacadeAccessor()
    {
        return PaymentProcesor::class;
    }
}
