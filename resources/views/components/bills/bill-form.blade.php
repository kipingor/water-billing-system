<div>
    <form x-data="{
        form: $form('post', '/bills', {
            meter_id: '',
            reading_value: '',
        }),
        selectedMeterId: null,
        errors: {},
        processing: false,
    
        submit() {
            this.processing = true;
            this.errors = {};
    
            this.form.submit()
                .then(response => {
                    console.log(response.status);
                    this.form.reset();
                    this.processing = false;
                    showSuccessToast('bill created successfully!');
                    this.updateMeterList(response.data.meters);
                })
                .catch(error => {
                    this.handleErrors(error);
                    this.processing = false;
                });
        },
    
        updateMeterList(meters) {
            this.$nextTick(() => {
                if (this.$refs.dropdownMeterList) {
                    this.$refs.dropdownMeterList.updateMeters(meters);
                }
            });
        },
    
        handleErrors(error) {
            if (error.response) {
                const status = error.response.status;
                const data = error.response.data;
    
                if (status === 422 && data && data.errors) {
                    this.errors = data.errors;
                    const errorMessage = Object.values(data.errors).flat().join(', ');
                    showErrorToast('Validation Error: ' + errorMessage);
                } else if (status === 500 && data && data.errors) {
                    showErrorToast('Server Error: ' + JSON.stringify(data.errors));
                } else {
                    showErrorToast('An unexpected error occurred.');
                    console.error('Unexpected Error:', error.response);
                }
            } else {
                showErrorToast('Network Error: Unable to reach the server.');
                console.error('Network Error:', error);
            }
        },
    }" @set-meter.window="form.meter_id = $event.detail;" @submit.prevent="submit()"
        class="space-y-12">
        @csrf
        @if ($bill)
            @method('PUT')
        @endif
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Bill</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Simply add the current meter reading.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-3 ">
                        <x-form.search-meters :meters="$meters" />
                        {{-- <x-bills.meter-dropdown-list :meters="$meters"  x-ref="dropdownMeterList" /> --}}
                        <template x-if="form.invalid('meter_id')">
                            <div x-text="form.errors.meter_id" class="text-red-500 text-sm"></div>
                        </template>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="reading_value" class="block text-sm font-medium leading-6 text-gray-700">Meter
                            Reading</label>
                        <div class="mt-2">
                            <input type="number" name="reading_value" id="reading_value" step="0.01"
                                inputmode="decimal" x-model="form.reading_value" @input="form.validate('reading_value')"
                                class="mt-1 block w-full invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                        </div>
                        <template x-if="form.invalid('reading_value')">
                            <div x-text="form.errors.reading_value" class="text-red-500 text-sm"></div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" :disabled="processing || !form.meter_id"
                :class="{
                    'cursor-not-allowed opacity-50': processing || !form.meter_id,
                    'hover:bg-sky-500': !processing && form.meter_id
                }"
                class="rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                <span x-show="!form.processing">Save</span>
                <span x-show="form.processing" class="inline-flex items-center leading-6">
                    <svg class="motion-reduce:hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Saving...
                </span>
            </button>
        </div>
    </form>
</div>
