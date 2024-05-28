<div x-data="meterList()">
    <div class="flex justify-between mb-4">
        <div>
            <input type="text" x-model="searchTerm" placeholder="Search customers..."
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <button type="button" @click="sortBy('name')"
                class="px-2 py-1 rounded-md text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-700">
                Name
                <span x-show="sortColumn === 'name'">
                    <span x-show="sortDirection === 'asc'">&#9652;</span>
                    <span x-show="sortDirection === 'desc'">&#9662;</span>
                </span>
            </button>
            <!-- Add more sort buttons as needed -->
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" @click.prevent="sortBy('meter_number')" class="cursor-pointer">
                            Meter Number
                            <span x-show="sortColumn === 'meter_number'" class="inline-flex">
                                <span x-show="sortDirection === 'asc'">&#8593;</span>
                                <span x-show="sortDirection === 'desc'">&#8595;</span>
                            </span>
                        </a>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Customer
                    </th>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Meter Type
                    </th>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Meter Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Installation Date
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="meter in filteredMeters">
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <span x-text="meter.meter_number"></span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="meter.customer.name"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="meter.location"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="meter.meter_type"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span x-text="meter.meter_status" :class="{
                               'text-green-500': meter.meter_status === 'active',
                               'text-red-500': meter.meter_status === 'inactive',
                               'text-orange-500': meter.meter_status === 'replaced',
                           }"></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="meter.installation_date">
                        </td>
                        <!-- Add more table cells as needed -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="`/meters/${meter.id}`" class="text-indigo-600 hover:text-indigo-900 mr-2">View</a>
                            <a href="`/meters/${meter.id}/edit`" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                            <button @click="deleteMeter(meter.id)"
                                class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div class="mt-4">
            <!-- Add pagination links here if needed -->
        </div>
    </div>
</div>