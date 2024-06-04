<div 
x-data="billData()" 
x-init="loadData()"
>
    @if ($bills->count() > 0)    

    <x-table
        :data="$bills"
        :headers="[
            ['key' => 'id', 'label' => 'Id'],
            ['key' => 'meter.customer', 'label' => 'Customer'],
            ['key' => 'meter.meter_number', 'label' => 'Meter Number'],
            ['key' => 'meter.location', 'label' => 'Location'],
            ['key' => 'amount', 'label' => 'Amount'],
            ['key' => 'status', 'label' => 'Status'],
        ]"
        :actions="[
            [
                'label' => 'View',
                'class' => 'text-sky-600 hover:text-sky-900',
                'handler' => '$dispatch(\'open-modal\', { name: \'billModal\', modalData: item })',
            ],
        ]"
        :sortColumn="'id'"
        :sortDirection="'desc'"
    ></x-table>
</div>
@else
<div class="flex justify-between mb-4 mx-auto px-12">
    <p class="px-24">No bills found.</p>
</div>

@endif
</div>

<!-- Customer Modal -->
<x-bill-modal  x-show="showBillModal" max-width="xl" @close-modal="closeBillModal()" title="Bill Details" name="billModal" x-transition>
    <h3 class="text-lg font-medium leading-6 text-gray-900">Payment successful</h3>
    <div class="mt-2 max-w-xl text-sm text-gray-500">
        
    </div>
    <div class="mt-4">
        
        <button
            type="button"
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            x-on:click="$dispatch('close', 'customerModal')"
        >
            Got it, thanks!
        </button>
    </div>
</x-slide-over-modal>