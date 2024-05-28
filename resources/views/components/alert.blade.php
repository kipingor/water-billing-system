@if(Session::has('alert'))
@php
    $alert = Session::get('alert');
    $type = $alert['type'];
    $position = $alert['position'];
    $message = $alert['message'];
    $typeClasses = [
        'info' => 'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200',
        'warning' => 'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200',
        'error' => 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
        'success' => 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200',
    ][$type];

    $typeIcon = '';
    if ($type === 'warning') {
        $typeIcon = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Warning icon</span>';
    } elseif ($type === 'error') {
        $typeIcon = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Error icon</span>';
    } elseif ($type === 'success') {
        $typeIcon = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Check icon</span>';
    } else {
        $typeIcon = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Info icon</span>';
    }

    $positionClasses = [
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
    ][$position];
@endphp

<div class="{{$positionClasses}} fixed cursor-pointer"
    x-data="{ showAlert: {{ Session::has('alert') ? 'true' : 'false' }} }"  
    x-show="showAlert" 
    x-transition:enter="transition ease-out duration-300" 
    x-transition:enter-start="opacity-0 transform translate-y-2" 
    x-transition:enter-end="opacity-100 transform translate-y-0" 
    x-transition:leave="transition ease-in duration-300" 
    x-transition:leave-start="opacity-100 transform translate-y-0" 
    x-transition:leave-end="opacity-0 transform translate-y-2"
    @click="showAlert=false">
    <div id="toast-{{ $type }}" class="flex items-center w-full max-w-xs p-4 mb-4 {{ $typeClasses }} text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200">
            {!! $typeIcon !!}
        </div>
        <div class="ms-3 text-sm font-normal">{{ $message }}</div>
        <button type="button" @click="showAlert=false" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-{{ $type }}" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('alertData', () => ({
            showAlert: false,
            init() {
                // Clear the alert after 3 seconds
                setTimeout(() => {
                    this.showAlert = false;
                }, 3000);
            }
        }));
    });
</script>
@endif