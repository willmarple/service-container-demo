<x-filament-panels::page>
    <div class="md:w-[600px]">
        <livewire:add-card @cardadded="$refresh" />
    </div>
    {{ $this->table }}
</x-filament-panels::page>
