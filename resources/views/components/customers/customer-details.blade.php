@props(['customer'])

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Customer Details</h1>

    <span>{{ $customer }}</span>
    <span x-text="customer.email"></span>


    <div class="bg-white shadow-md rounded-lg p-6">
        <h5 class="text-xl font-bold mb-2">{{ $customer->first_name }} {{ $customer->last_name }}</h5>
        <p class="text-gray-700"><span class="font-bold">Email:</span> {{ $customer->email }}</p>
        <p class="text-gray-700"><span class="font-bold">Phone Number:</span> {{ $customer->phone_number }}</p>
        <p class="text-gray-700"><span class="font-bold">ID Number:</span> {{ $customer->idnumber }}</p>
        <p class="text-gray-700"><span class="font-bold">Physical Address:</span> {{ $customer->physical_address }}</p>
        <p class="text-gray-700"><span class="font-bold">Postal Address:</span> {{ $customer->postal_address }}</p>
        <p class="text-gray-700"><span class="font-bold">Account Number:</span> {{ $customer->account_number }}</p>
        <p class="text-gray-700"><span class="font-bold">Account Status:</span> {{ $customer->account_status }}</p>
    </div>

    {{-- <a href="{{ route('customers.edit', $customer) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Edit Customer</a> --}}
</div>