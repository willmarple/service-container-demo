<x-filament-panels::page>
    <div class="md:w-[600px]">
        <livewire:add-card />
    </div>

    @foreach ($paymentMethods as $paymentMethod)
        <div class="flex flex-row justify-between md:w-[600px] mb-4">
            <span class="flex-1">{{$paymentMethod['brand']}}</span>
            <span class="flex-1">{{$paymentMethod['last4']}}</span>
            <span class="flex-1">{{$paymentMethod['exp_month']}} / {{$paymentMethod['exp_year']}}</span>
            <span class="flex-1">
                <button wire:click="deleteCard('{{$paymentMethod['id']}}')"
                    class="bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
                    Delete
                </button>
        </div>
    @endforeach
</x-filament-panels::page>
