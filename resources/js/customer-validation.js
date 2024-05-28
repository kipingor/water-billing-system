import { defineRule } from '@alpinejs/form';

defineRule('validEmail', value => {
    // Regular expression pattern for email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(value);
});

defineRule('validPhoneNumber', value => {
    // Regular expression pattern for phone number validation
    const phonePattern = /^\+?\d{1,3}?[-\s]?\(?\d{3}\)?[-\s]?\d{3}[-\s]?\d{4}$/;
    return phonePattern.test(value);
});

// Define more custom validation rules as needed