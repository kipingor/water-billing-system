<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bill Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- This is the begining of the design -->
                    <div class="grid grid-rows-14 grid-cols-6 grid-flow-col gap-4 text-sm text-center font-bold leading-6 bg-gray-200">
                        <div class="p-4 rounded-lg shadow-lg col-start-2 col-span-4 bg-blue-400 ">heading</div>
                        <div class="p-4 rounded-lg shadow-lg col-start-1 col-end-3 bg-blue-400"><span class="uppercase">Meter Reading</span></div>
                        <div class="p-4 rounded-lg shadow-lg col-end-7 col-span-4 bg-blue-400">Meter reading details, include previous meter reading, current meter reading and consumption</div>
                        <div class="p-4 rounded-lg shadow-lg row-span-2 col-start-1 col-end-3 grid place-content-center bg-blue-400"><span class="uppercase">Meter Reading</span></div>
                    </div>
                    <!-- This is the end of the design -->
                    <h2 class="text-lg font-semibold">Customer details</h2>
                    <p>{{ $bill->meter->customer->first_name }} {{ $bill->meter->customer->last_name }}</p>
                    <p>{{ $bill->meter->customer->email }}</p>
                    <p>{{ $bill->meter->customer->phone_number }}</p>
                    <p>{{ $bill->meter->customer->idnumber }}</p>
                    <p>{{ $bill->meter->customer->physical_address }}</p>
                    <p>{{ $bill->meter->customer->postal_address }}</p>
                    <p>{{ $bill->meter->customer->account_status }}</p>
                    <h2 class="text-lg font-semibold">Meter details</h2>           
                    <p>{{ $bill->meter->meter_number }}</p>
                    <p>{{ $bill->meter->location }}</p>
                    <p>{{ $bill->meter->meter_type }}</p>
                    <p>{{ $bill->meter->meter_status }}</p>
                    <p>{{ \Carbon\Carbon::parse($bill->meter->installation_date)->toFormattedDateString() }}</p>
                    <h2 class="text-lg font-semibold">Bill details</h2>
                    <p>{{ $bill->id }}</p>
                    <p>{{ $bill->billing_period }}</p>
                    <p>{{ \Carbon\Carbon::parse($bill->due_date)->toFormattedDateString() }}</p>
                    <p>{{ $bill->amount }}</p>
                    <p>{{ $bill->status }}</p>
                    <h2 class="text-lg font-semibold">Payment Details</h2>
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                          <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Date</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference Number</th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          @foreach($bill->payments as $payment)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($payment->payment_date)->toFormattedDateString() }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->amount }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->payment_method }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->reference_number }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    {{-- <x-bills.bill-details :bill="$bill" /> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>