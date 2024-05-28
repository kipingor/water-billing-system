import axios from 'axios';

document.addEventListener('alpine:init', () => {
    Alpine.data('meterReadingForm', () => ({
        form: {
            meter_id: '',
            reading_date: '',
            reading_value: '',
            employee_id: null,
            reading_type: 'manual',
        },
        errors: {},
        processing: false,

        submit() {
            this.processing = true;
            this.errors = {};

            axios
                .post('/meter-readings', this.form)
                .then(response => {
                    // Handle successful response
                    console.log(response.data);
                    // Reset the form and errors after successful submission
                    this.form = {
                        meter_id: '',
                        reading_date: '',
                        reading_value: '',
                        employee_id: null,
                        reading_type: 'manual',
                    };
                    this.processing = false;
                })
                .catch(error => {
                    // Handle validation errors
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                    this.processing = false;
                });
        },
    }));
});