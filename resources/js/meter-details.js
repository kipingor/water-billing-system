document.addEventListener('alpine:init', () => {
    Alpine.data('meterDetails', () => ({
        meter: {}, // Replace with your meter data
        meterReadings: [], // Replace with your meter reading data
    }));
});