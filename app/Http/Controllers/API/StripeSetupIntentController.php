<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Services\Support\Facades\Payment;
use Illuminate\Http\Request;

class StripeSetupIntentController
{
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|string',
        ]);

        $paymentMethodId = $request->input('payment_method_id');
        /** @var User $user */
        $user = auth()->user();

        $setupIntent = Payment::client()->setupIntents->create([
            'customer'             => $user->stripe_id,
            'payment_method_types' => ['card'],
            'payment_method'       => $paymentMethodId,
            'confirm'              => true,
        ]);

        return response()->json($setupIntent);
    }
}
