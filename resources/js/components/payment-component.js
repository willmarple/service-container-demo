import { createSetupIntent } from '../lib/stripe.js';

export default function paymentComponent() {
    return {
        stripe: window.stripe,
        elements: null,
        card: null,

        init() {
            this.elements = this.stripe.elements();
            this.card = this.elements.create('card', {
                classes: {
                    base: 'border border-white rounded-md shadow-sm px-4 py-2 text-white',
                },
                style: {
                    base: {
                        color: '#fff',
                        '::placeholder': {
                            color: '#fff',
                        },
                    },
                }
            });
            this.card.mount('#card-element');
        },

        async createPaymentMethod() {
            try {
                const result = await this.stripe.createPaymentMethod('card', this.card);
                if (result.error) {
                    // Show error to your customer
                    console.log(result.error.message);
                } else {
                    console.log('PaymentMethod created', result);
                    this.paymentMethod = result.paymentMethod;
                    const newStoredCard = await createSetupIntent(this.paymentMethod.id);
                    window.location.reload();
                }
            } catch (error) {
                console.error(error);
            }
        }
    }
}
