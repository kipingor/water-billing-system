import { defineRule } from '@alpinejs/form';

defineRule('validReadingValue', value => {
    // Regular expression pattern for reading value validation
    const readingValuePattern = /^\d+(\.\d{1,2})?$/;
    return readingValuePattern.test(value);
});

// Define more custom validation rules as needed