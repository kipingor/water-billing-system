import axios from 'axios';

document.addEventListener('alpine:init', () => {
    Alpine.data('billCreationComponent', () => ({
        form: {
            meter_id: '',
            due_date: '',
            billing_period: '',
            reading_value: '',
        },
        errors: {},
        processing: false,

        submit() {
            const selectedMeter = this.meters.find(meter => meter.id === this.formData.meter_id);
            if (!selectedMeter) {
                alert('Error: Selected meter not found.');
                return;
            }
            const lastReading = selectedMeter.lastReading ? selectedMeter.lastReading.value : 0; // Adjust according to your data structure

            if (parseInt(this.formData.reading_value) < lastReading) {
                alert('Error: The current reading must be greater than the last reading.');
                return;
            } else if (parseInt(this.formData.reading_value) === lastReading) {
                alert('No need for a new bill. The consumption is zero.');
                return;
            }
            console.log('Submitting form with data:', this.form);
            this.processing = true;
            this.errors = {};

            axios
                .post('/api/bills/create', this.form)
                .then(response => {
                    // Handle successful response
                    console.log(response.data);
                    // Reset the form and errors after successful submission
                    // Implement form submission logic here
                    // e.g., send data to the server using Axios or Fetch API
                    // and handle the response

                    // Reset the form and errors after successful submission
                    this.form = {
                        meter_id: '',
                        due_date: '',
                        billing_period: '',
                        reading_value: '',
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