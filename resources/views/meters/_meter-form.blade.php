<div x-data="meterForm">
    <form x-on:submit.prevent="submit" class="space-y-4">
        <!-- Meter Form Fields -->
        <div class="mb-4">
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
            <select id="customer_id" x-model="form.customer_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select a customer</option>
                <!-- Options for customers -->
            </select>
            <span x-text="errors.customer_id" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="meter_number" class="block text-sm font-medium text-gray-700">Meter Number</label>
            <input type="text" id="meter_number" x-model="form.meter_number"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-text="errors.meter_number" class="text-red-500 text-sm"></span>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" id="location" x-model="form.location"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="meter_type" class="block text-sm font-medium text-gray-700">Meter Type</label>
            <select id="meter_type" x-model="form.meter_type"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="analog">Analog</option>
                <option value="digital">Digital</option>
            </select>
        </div>

        <div>
            <label for="meter_status" class="block text-sm font-medium text-gray-700">Meter Status</label>
            <select id="meter_status" x-model="form.meter_status"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="replaced">Replaced</option>
            </select>
        </div>

        <div>
            <label for="installation_date" class="block text-sm font-medium text-gray-700">Installation Date</label>
            <input type="date" id="installation_date" x-model="form.installation_date"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="pt-5">

            <!-- Submit and Reset Buttons -->
            <button type="submit" :disabled="processing"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span x-show="!processing">Save</span>
                <span x-show="processing">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Saving...</span>
            </button>
        </div>
    </form>
</div>