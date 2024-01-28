export async function createSetupIntent(paymentMethodId) {
    try {
        return await axios.post('/api/stripe/setup-intent', { payment_method_id: paymentMethodId });
    } catch (error) {
        console.error(error);
    }
}
