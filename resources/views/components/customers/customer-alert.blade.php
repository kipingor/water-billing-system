@props(['type' => 'info', 'message'])

@php
    $alertTypes = [
        'info' => 'bg-blue-100 text-blue-800',
        'success' => 'bg-green-100 text-green-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        'danger' => 'bg-red-100 text-red-800',
    ];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition
     class="p-4 rounded-md {{ $alertTypes[$type] }} shadow-md mb-4" role="alert">
    <div class="flex items-center justify-between">
        <p>{{ $message }}</p>
        <button type="button" @click="show = false" class="text-gray-500 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
</div>