<div>
    <form x-data="{
        form: $form('post', '/customers', {
            first_name: '',
            last_name: '',
            email: '',
            phone_number: '',
            idnumber: '',
            physical_address: '',
            postal_address: '',
            account_status: 'active',
        }), 
        errors: {},
        processing: false,

        submit() {
            this.processing = true;
            this.errors = {};

            this.form.submit()
            .then(response => {
                console.log(response.data);
                form.reset();
    
                alert('Customer created.')
                this.processing = false;
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    alert('Validation Error: ' + JSON.stringify(error.response.data.errors));
                } else {
                    alert('Error while creating new customer.' + JSON.stringify(error.response.data.errors));
                }   
                this.processing = false;             
            });
        },
    }" @submit.prevent="submit()" class="space-y-12">
        @csrf
        @if ($customer)
        @method('PUT')
        @endif
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Customer</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm font-medium leading-6 text-gray-700">{{
                            __('customers.fields.first_name')
                            }}</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-sky-600 sm:max-w-md">
                                <input type="text" id="first_name" x-model="form.first_name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6"
                                    autocomplete="given-name" placeholder="First Name">
                            </div>
                            <template x-if="form.invalid('first_name')">
                                <div x-text="form.errors.first_name" class="text-red-500 text-sm"></div>
                            </template>
                        </div>
                    </div>

                    <div class="sm:col-span-3 ">
                        <label for="last_name" class="block text-sm font-medium leading-6 text-gray-700">{{
                            __('customers.fields.last_name')
                            }}</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-sky-600 sm:max-w-md">
                                <input type="text" id="last_name" x-model="form.last_name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6"
                                    placeholder="Last Name">
                            </div>
                            <template x-if="form.invalid('last_name')">
                                <div x-text="form.errors.last_name" class="text-red-500 text-sm"></div>
                            </template>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-700">{{
                            __('customers.fields.email')
                            }}</label>
                        <div class="mt-2">
                            <input id="email" name="email" x-model="form.email" @change="form.validate('email')"
                                autocomplete="email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                            <template x-if="form.invalid('email')">
                                <div x-text="form.errors.email" class="text-red-500 text-sm"></div>
                            </template>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-700">{{
                            __('customers.fields.phone_number') }}</label>
                        <div class="mt-2">
                            <input type="tel" id="phone_number" x-model="form.phone_number"
                                @change="form.validate('phone_number')"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                            <template x-if="form.invalid('phone_number')">
                                <div x-text="form.errors.phone_number" class="text-red-500 text-sm"></div>
                            </template>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="idnumber" class="block text-sm font-medium leading-6 text-gray-700">{{
                            __('customers.fields.idnumber')
                            }}</label>
                        <div class="mt-2">
                            <input type="text" id="idnumber" x-model="form.idnumber"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                            <template x-if="form.invalid('idnumber')">
                                <div x-text="form.errors.idnumber" class="text-red-500 text-sm"></div>
                            </template>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="physical_address" class="block text-sm font-medium leading-6 text-gray-700">{{
                            __('customers.fields.physical_address') }}</label>
                        <div class="mt-2">
                            <textarea id="physical_address" x-model="form.physical_address"
                                class="block w-full rounded-md border-0 py-1.5 border-gray-300 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6"
                                rows="3"></textarea>
                            <template x-if="form.invalid('physical_address')">
                                <div x-text="form.errors.physical_address" class="text-red-500 text-sm"></div>
                            </template>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="postal_address" class="block text-sm font-medium leading-6 text-gray-700">{{
                            __('customers.fields.postal_address') }}</label>
                        <div class="mt-2">
                            <textarea id="postal_address" x-model="form.postal_address"
                                class="block w-full rounded-md border-0 py-1.5 border-gray-300 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6"
                                rows="3"></textarea>
                            <template x-if="form.invalid('postal_address')">
                                <div x-text="form.errors.postal_address" class="text-red-500 text-sm"></div>
                            </template>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="account_status" class="block text-sm font-medium leading-6 text-gray-700">Account
                            Status</label>
                        <div class="mt-2">
                            <select id="account_status" x-model="form.account_status"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" :disabled="form.processing"
                class="rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                <span x-show="!form.processing">Save</span>
                <span x-show="form.processing">Saving...</span>
            </button>
        </div>
    </form>
</div>