<div class="p-6 text-gray-900 dark:text-gray-100">
    <div class="grid grid-cols-6 gap-2">
        <div class="col-start-2 col-span-4 text-center font-bold text-xl">Water Billing Details</div>
    </div>
    <div class="mt-4">
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
        <p>{{ \Carbon\Carbon::parse($bill->billing_period)->toFormattedDateString() }}</p>
        <p>{{ \Carbon\Carbon::parse($bill->due_date)->toFormattedDateString() }}</p>
        <p>{{ $bill->amount }}</p>
        <p>{{ $bill->status }}</p>
        <h2 class="text-lg font-semibold">Payment Details</h2>
        <table class="w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Payment Date</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Method</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Reference Number</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($bill->payments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($payment->payment_date)->toFormattedDateString() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->payment_method }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->reference_number }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
