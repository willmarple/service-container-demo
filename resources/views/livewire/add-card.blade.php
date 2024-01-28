<div x-data="paymentComponent()" x-init="init()">
    <div wire:ignore id="card-element" class='mb-8'>
        <!-- A Stripe Element will be inserted here. -->
    </div>

    <button x-on:click="createPaymentMethod"
        class="bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 mt-4 rounded">
        Save
    </button>
</div>
