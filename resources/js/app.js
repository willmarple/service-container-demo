import './bootstrap';
import paymentComponent from './components/payment-component';

window.stripe = Stripe(import.meta.env.VITE_STRIPE_PUBLIC_KEY);

Alpine.data('paymentComponent', paymentComponent);
