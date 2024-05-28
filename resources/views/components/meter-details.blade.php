<div x-data="meterDetails">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Meter Information
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Meter details and readings.
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div
                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">
                        Meter Number
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span x-text="meter.meter_number"></span>
                    </dd>
                </div>
                <div
                    class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Customer</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span x-text="meter.customer.name"></span>
                    </dd>
                </div>
                <div
                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span x-text="meter.location"></span>
                    </dd>
                </div>
                <div
                    class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">
                        Meter Type
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span x-text="meter.meter_type"></span>
                    </dd>
                </div>
                <div
                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span
                            x-text="meter.meter_status"
                            :class="{
                                'text-green-500': meter.meter_status === 'active',
                                'text-red-500': meter.meter_status === 'inactive',
                                'text-orange-500': meter.meter_status === 'replaced',
                            }"
                        ></span>
                    </dd>
                </div>
                <div
                    class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">
                        Installation Date
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span x-text="meter.installation_date"></span>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Meter Readings
        </h3>
        <div class="mt-4">
            <!-- Display meter readings here -->
            <table class="w-full bg-white shadow-md rounded mb-4">
                <thead>
                    <tr>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                        >
                            Reading Date
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                        >
                            Reading Value
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                        >
                            Reading Type
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                        >
                            Employee
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="reading in meter.meter_readings">
                        <tr class="hover:bg-gray-100">
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                <span x-text="reading.reading_date"></span>
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                <span x-text="reading.reading_value"></span>
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                <span x-text="reading.reading_type"></span>
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                <span x-text="reading.employee.name"></span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
 </div>
 <script></script>