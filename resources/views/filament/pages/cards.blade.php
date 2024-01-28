<x-filament-panels::page>
    <div class="md:w-[600px]">
        <livewire:add-card />
    </div>

    @foreach ($paymentMethods as $paymentMethod)
        <div class="md:w-[600px]">
            <span>{{$paymentMethod->id}}</span>
        </div>

    @endforeach
</x-filament-panels::page>
