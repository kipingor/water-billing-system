<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bills') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-between mb-6">
        <a
            href="{{ route('bills.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Add New Bill
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-bills.bill-list />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>