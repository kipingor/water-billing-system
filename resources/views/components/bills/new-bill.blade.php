<div x-data="billCreationComponent()" x-init="loadData()" @click.away="closeModal()">
    <x-button type="button" @click="openModal()">Create a new water Bill</x-button>

    <div x-show="showModal" style="background-color: rgba(0,0,0,0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
        <template x-if="form.validating">
            <div>Validating...</div>
        </template>
        <form @submit.prevent="submit()" class="space-y-12 rounded-b-lg p-10 bg-white">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Create a new Bill</h2>

                    <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:mt-10 sm:grid-cols-6 sm:gap-y-8">
                        <div class="sm:col-span-2">
                            <label for="meter_id" class="block text-sm font-medium leading-6 text-gray-700">Meter:</label>
                            <div class="mt-2">
                                <select x-model="form.meter_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="" disabled selected>Select a Meter to Bill</option>
                                    <template x-for="meter in meters">
                                        <option :value="meter.id" x-text="meter.meter_number + ' - ' + (meter.customer ? meter.customer.first_name + ' ' + meter.customer.last_name : 'No customer')"></option>
                                    </template>
                                </select>
                            </div>
                            <template x-if="form.invalid('meter_id')">
                                <div x-text="form.errors.meter_id" class="text-red-500 text-sm"></div>
                            </template>
                        </div>

                        <div class="sm:col-span-1">
                            <label for="due_date" class="block text-sm font-medium leading-6 text-gray-700">Due Date:</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-sky-600 sm:max-w-md">                                    
                                    <input type="date" x-model="form.due_date" 
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                                </div>
                                <template x-if="form.invalid('due_date')">
                                    <div x-text="form.errors.due_date" class="text-red-500 text-sm"></div>
                                </template>
                            </div>
                        </div>

                        <div class="sm:col-span-1">
                            <label for="billing_period" class="block text-sm font-medium leading-6 text-gray-700">Billing Period:</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-sky-600 sm:max-w-md">                                    
                                    <input type="text" x-model="form.billing_period" 
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                                </div>
                                <template x-if="form.invalid('billing_period')">
                                    <div x-text="form.errors.billing_period" class="text-red-500 text-sm"></div>
                                </template>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="reading_value" class="block text-sm font-medium leading-6 text-gray-700">Current Meter Reading:</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-sky-600 sm:max-w-md">                                    
                                    <input type="number" x-model="form.reading_value" 
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                                </div>
                                <template x-if="form.valid('email')">
                                    <span>✅</span>
                                </template>
                                <template x-if="form.invalid('reading_value')">
                                    <div x-text="form.errors.reading_value" class="text-red-500 text-sm"></div><span>❌</span>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                {{-- <button type="submit" 
                class="rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                   Create bill and Email/SMS
                </button>
                <button type="submit" 
                class="rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                    Create bill and Save
                </button> --}}
                <button type="submit" :disabled="form.processing"
                class="rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                    <span x-show="!form.processing">Save</span>
                    <span x-show="form.processing">Saving...</span>
                </button>
                <x-button type="button" @click="closeModal()">Close</x-button>
            </div>
        </form>
    </div>
</div>

<script>
    function billCreationComponent() {
        return {
            form: $form('post', '/api/bills/create', {
                meter_id: '',
                due_date: '',
                billing_period: '',
                reading_value: '',
            }),
            meters: [],
            errors: {},
            processing: false,
            showModal: false,

            loadData() {
                // Load data from the server
                const meterDataElement = document.getElementById('meterData');
                if(!meterDataElement) {
                    alert('Error: unable to get Meter Data.');
                    return;
                }
                this.meters = JSON.parse(meterDataElement.dataset.meters);
                
                console.log("Data loaded", this.meters);       
            },

            submit() {                
                const selectedMeter = this.meters.find(meter => meter.id === this.form.meter_id);
                if (!selectedMeter) {
                    alert('Error: Selected meter not found.');
                    return;
                }
                console.log(this.form); // Check if form is defined
                console.log(this.form.meter_id);
                const lastReading = selectedMeter.lastReading ? selectedMeter.lastReading.value : 0; // Adjust according to your data structure

                if (parseInt(this.form.reading_value) < lastReading) {
                    alert('Error: The current reading must be greater than the last reading.');
                    return;
                } else if (parseInt(this.form.reading_value) === lastReading) {
                    alert('No need for a new bill. The consumption is zero.');
                    return;
                }
                console.log('Submitting form with data:', this.form);
                this.processing = true;
                this.errors = {};
                
                this.form.submit()
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

            initDueDate() {
                let today = new Date();
                today.setDate(today.getDate() + 15);
                this.form.due_date = ('0' + today.getDate()).slice(-2) + '/' + ('0' + (today.getMonth() + 1)).slice(-2) + '/' + today.getFullYear(); // Format as 'DD/MM/YYYY'
            },
            
            openModal() {
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
                this.form = {
                    meter_id: '',
                    due_date: '',
                    billing_period: '',
                    reading_value: '',
                };
                this.processing = false;
            },
        }
    }
</script>
