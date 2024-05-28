document.addEventListener('alpine:init', () => {
    Alpine.data('meterReadingDetails', () => ({
        meterReading: {}, // Replace with your meter reading data
        meter: {}, // Replace with your meter data
        employee: {}, // Replace with your employee data (if applicable)
    }));
});