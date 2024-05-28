import axios from 'axios';

document.addEventListener('alpine:init', () => {
    Alpine.data('meterForm', () => ({
        form: {
            customer_id: '',
            meter_number: '',
            location: '',
            meter_type: 'analog',
            meter_status: 'active',
            installation_date: '',
        },
        errors: {},
        processing: false,

        submit() {
            this.processing = true;
            this.errors = {};

            axios
                .post('/meters', this.form)
                .then(response => {
                    // Handle successful response
                    console.log(response.data);
                    // Reset the form and errors after successful submission
                    this.form = {
                        customer_id: '',
                        meter_number: '',
                        location: '',
                        meter_type: 'analog',
                        meter_status: 'active',
                        installation_date: '',
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