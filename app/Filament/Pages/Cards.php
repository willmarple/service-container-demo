<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\User;
use App\Services\Stripe\Facades\Stripe;

class Cards extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.cards';

    protected function getViewData(): array
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->stripe_id) {
            $customer = Stripe::client()->customers->create([
                'email' => $user->email,
                'name'  => $user->name,
            ]);

            $user = tap($user)->update([
                'stripe_id' => $customer->id,
            ]);
        }

        $data = Stripe::client()->paymentMethods->all([
            'customer' => $user->stripe_id,
            'type' => 'card',
        ])['data'];

        $paymentMethods = collect($data)->map(fn ($paymentMethod) => [
            'id' => $paymentMethod->id,
            ...$paymentMethod->card->toArray()
        ])->all();

        ray('BUILDING VIEW DATA', $paymentMethods);

        return [
            'paymentMethods' => $paymentMethods,
        ];
    }

    public function deleteCard(string $paymentMethodId)
    {
        Stripe::client()->paymentMethods->detach(
            $paymentMethodId
        );
    }
}
