<?php

namespace App\Filament\Pages;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\Stripe\Facades\Stripe;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class Cards extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.cards';

    protected function getViewData(): array
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->stripe_id) {
            $customer = Stripe::client()->customers->create([
                'email' => $user->email,
                'name' => $user->name,
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
            ...$paymentMethod->card->toArray(),
        ])->all();

        return [
            'paymentMethods' => $paymentMethods,
        ];
    }

    public function table(Table $table): Table
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->stripe_id) {
            $customer = Stripe::client()->customers->create([
                'email' => $user->email,
                'name' => $user->name,
            ]);

            $user = tap($user)->update([
                'stripe_id' => $customer->id,
            ]);
        }

        return $table
            ->query(PaymentMethod::setCustomer($user->stripe_id))
            ->columns([
                TextColumn::make('brand')
                    ->formatStateUsing(function ($state) {
                        return new HtmlString(
                            '<div class="flex">
                                <span class="my-auto">' . ucfirst($state) . '</span>
                                <img src="https://raw.githubusercontent.com/aaronfagan/svg-credit-card-payment-icons/main/flat-rounded/' . strtolower($state) . '.svg" class="w-8 h-8 my-auto ml-2">
                            </div>'
                        );
                    }),
                TextColumn::make('last4'),
                TextColumn::make('exp'),
                TextColumn::make('created_at')->formatStateUsing(function ($state) {
                    return Carbon::parse($state)->timezone('America/New_York')->format('m/d/Y H:i');
                }),

            ])
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
