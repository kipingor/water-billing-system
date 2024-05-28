@props(['show' => false, 'maxWidth' => '2xl', 'title' => 'My Title', 'name' => 'name'])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth ?? '2xl'];
@endphp

<div
    x-data="{ show: @js($show), modalData: @entangle('modalData') }"
    x-cloak
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-show="show"
    x-on:open-modal.window="
    console.log('Event received', $event.detail);
    if ($event.detail.name === '{{ $name }}') {
        show = true;
        modalData = $event.detail.data || {}; // Store additional data if provided
    }
    console.log('Show:', show);"
    x-on:close-modal.window="
    if ($event.detail.name === '{{ $name }}') {
        show = false;
        modalData = {}; // Reset modal data
    }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:click.outside="show = false"
    class="fixed inset-0 overflow-hidden z-50"
    aria-labelledby="slide-over-title"
    role="dialog"
    aria-modal="true"
>
    <pre x-text="JSON.stringify(modalData, null, 2)"></pre>
    <div class="absolute inset-0 overflow-hidden">
        <div
            x-show="show"
            x-transition:enter="ease-in-out duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in-out duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            aria-hidden="true"
        ></div>

        <div class="fixed inset-y-0 left-0 pr-10 max-w-full flex">
            <div
                x-show="show"
                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="relative {{ $maxWidthClass }} w-screen max-w-md"
            >
                <div class="absolute top-0 left-0 -ml-8 pt-4 pr-2 flex sm:-ml-10 sm:pr-4">
                    <button
                        type="button"
                        x-on:click="show = false"
                        class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                    >
                        <span class="sr-only">Close panel</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        close
                    </button>
                </div>

                <div class="h-full bg-white p-8 flex flex-col overflow-y-scroll">
                    <div class="px-4 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">{{ $title }}</h2>
                    </div>
                    <div class="mt-6 relative flex-1 px-4 sm:px-6">
                        <!-- Modal content goes here -->
                        <div class="container mx-auto px-4 py-8">
                            <h1 class="text-3xl font-bold mb-6">Bill Details</h1>
                        
                            <div class="bg-white shadow-md rounded-lg p-6">
                                <h5 class="text-xl font-bold mb-2" x-text="modalData.meter.customer"></h5>
                                
                            </div>
                        
                            {{-- <a href="{{ route('customers.edit', $customer) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Edit Customer</a> --}}
                        </div>
                        
                        <x-bills.bill-details x-bind:bill="modalData" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>