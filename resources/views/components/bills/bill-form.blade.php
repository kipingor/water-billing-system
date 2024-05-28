<div>
    <form x-data="{
        form: $form('post', '/bills', {
            meter_id: '',           
            reading_value: '',
        }),        
        errors: {},
        processing: false,

        submit() {            
            this.processing = true;
            this.errors = {};
            
            this.form.submit()
            .then(response => {
                console.log(response.status);
                
                alert(response.data.message);    
                this.form.reset();
                
                this.processing = false;
            })
            .catch(error => {
                
                if (error.response && error.response.status === 422 && error.response.data && error.response.data.errors) {
                    alert('Validation Error: ' + JSON.stringify(error.response.data.errors));
                } else if (error.response && error.response.data && error.response.data.errors && error.response.status === 500) {
                    alert('Error while creating new bill: ' + JSON.stringify(error.response.data.errors));
                } else if (error.response.status === 500) {
                    console.log(error.response.statusText + ' ' + error.response.headers + ' ' +  JSON.stringify(error.response.data));
                } else {
                    alert('An unexpected error occurred.');
                }
                this.processing = false;             
            });
        },
    }" @submit.prevent="submit()" class="space-y-12">
        @csrf
        @if ($bill)
        @method('PUT')
        @endif
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Bill</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Simply add the current meter readind.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3 ">
                        <label for="meter_id" class="block text-sm font-medium leading-6 text-gray-700">Meter ID:</label>
                        <div class="mt-2">
                            <select name="meter_id" id="meter_id" x-model="form.meter_id" @change="form.validate('meter_id')"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="" disabled selected>Select a Meter to Bill</option>
                                @foreach ($meters as $meter)
                                    <option value="{{ $meter->id }}">{{ $meter->meter_number }} - {{ $meter->customer->first_name }} {{ $meter->customer->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <template x-if="form.invalid('meter_id')">
                            <div x-text="form.errors.meter_id" class="text-red-500 text-sm"></div>
                        </template>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="reading_value" class="block text-sm font-medium leading-6 text-gray-700">Meter Reading</label>
                        <div class="mt-2">
                            <input type="text" name="reading_value" id="reading_value" x-model="form.reading_value" @change="form.validate('reading_value')" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">                            
                        </div>
                        <template x-if="form.invalid('reading_value')">
                            <div x-text="form.errors.reading_value" class="text-red-500 text-sm"></div>
                        </template>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" :disabled="form.processing" 
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <span x-show="!form.processing">Save</span>
                <span x-show="form.processing">Saving...</span>
            </button>
        </div>
    </form>
</div>