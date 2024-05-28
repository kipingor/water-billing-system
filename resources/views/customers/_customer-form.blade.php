<div x-data="{
    form: $form('post', '/customer/store', {
        first_name: '',
        last_name: '',
        email: '',
        phone_number: '',
        idnumber: '',
        physical_address: '',
        postal_address: '',
        account_number: '',
        account_status: 'active',
    })
}">

    <form x-on:submit.prevent="submit()" class="space-y-4">
        @csrf
        @if ($customer)
            @method('PUT')
        @endif
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">{{ __('customers.fields.first_name')
                }}</label>
            <input type="text" id="first_name" x-model="form.first_name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-text="form.errors.first_name" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">{{ __('customers.fields.last_name')
                }}</label>
            <input type="text" id="last_name" x-model="form.last_name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-text="form.errors.last_name" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('customers.fields.email')
                }}</label>
            <input id="email" name="email" x-model="form.email"  @change="form.validate('email')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-text="form.errors.email" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="phone_number" class="block text-sm font-medium text-gray-700">{{
                __('customers.fields.phone_number') }}</label>
            <input type="tel" id="phone_number" x-model="form.phone_number" @change="form.validate('phone_number')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-text="form.errors.phone_number" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="idnumber" class="block text-sm font-medium text-gray-700">{{ __('customers.fields.idnumber')
                }}</label>
            <input type="text" id="idnumber" x-model="form.idnumber" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-text="form.errors.idnumber" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="physical_address" class="block text-sm font-medium text-gray-700">{{
                __('customers.fields.physical_address') }}</label>
            <textarea id="physical_address" x-model="form.physical_address"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                cols="30" rows="10"></textarea>
            <span x-text="form.errors.physical_address" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="postal_address" class="block text-sm font-medium text-gray-700">{{
                __('customers.fields.postal_address') }}</label>
            <textarea id="postal_address" x-model="form.postal_address"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                cols="30" rows="10"></textarea>
            <span x-text="form.errors.postal_address" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="account_number" class="block text-sm font-medium text-gray-700">{{
                __('customers.fields.account_number') }}</label>
            <input type="text" id="account_number" x-model="form.account_number"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-text="form.errors.account_number" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="account_status" class="block text-sm font-medium text-gray-700">Account Status</label>
            <select id="account_status" x-model="form.account_status"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="suspended">Suspended</option>
            </select>
        </div>

        <div class="pt-5">
            <button type="submit" :disabled="form.processing"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span x-show="!processing">Save</span>
                <span x-show="processing">Saving...</span>
            </button>
        </div>
    </form>
</div>