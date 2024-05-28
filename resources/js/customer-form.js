import axios from 'axios';

document.addEventListener('alpine:init', () => {
    Alpine.data('customerForm', () => ({
        form: {
            first_name: '',
            last_name: '',
            email: '',
            phone_number: '',
            idnumber: '',
            physical_address: '',
            postal_address: '',
            account_number: '',
            account_status: 'active',
        },
        errors: {},
        processing: false,

        submit() {
            this.processing = true;
            this.errors = {};

            axios
                .post('/customers', this.form)
                .then(response => {
                    // Handle successful response
                    console.log(response.data);
                    // Reset the form and errors after successful submission
                    // Implement form submission logic here
                    // e.g., send data to the server using Axios or Fetch API
                    // and handle the response

                    // Reset the form and errors after successful submission
                    this.form = {
                        first_name: '',
                        last_name: '',
                        email: '',
                        phone_number: '',
                        idnumber: '',
                        physical_address: '',
                        postal_address: '',
                        account_number: '',
                        account_status: 'active',
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