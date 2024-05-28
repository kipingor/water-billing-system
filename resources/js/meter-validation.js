import { defineRule } from '@alpinejs/form';

defineRule('validMeterNumber', value => {
    // Regular expression pattern for meter number validation
    const meterNumberPattern = /^[A-Za-z0-9]+$/;
    return meterNumberPattern.test(value);
});

// Define more custom validation rules as needed