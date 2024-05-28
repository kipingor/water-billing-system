document.addEventListener('alpine:init', () => {
    Alpine.data('customerDetails', () => ({
        customer: {}, // Replace with your customer data
        meters: [], // Replace with your meter data
        bills: [], // Replace with your bill data
        notifications: [], // Replace with your notification data
    }));
});