<div 
x-data="customerData()" 
x-init="loadData()"
>
    @if ($customers->count() > 0)    

    <x-table
        :data="$customers"
        :headers="[
            ['key' => 'first_name', 'label' => 'Name'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'phone_number', 'label' => 'Phone Number'],
            ['key' => 'account_number', 'label' => 'Account Number'],
            ['key' => 'account_status', 'label' => 'Account Status'],
        ]"
        :actions="[
            [
                'label' => 'View',
                'class' => 'text-indigo-600 hover:text-indigo-900',
                'handler' => '$dispatch(\'open-modal\', { name: \'customerModal\', data: item })',
            ],
        ]"
        :sortColumn="'first_name'"
        :sortDirection="'asc'"
    ></x-table>
</div>
@else
<div class="flex justify-between mb-4 mx-auto px-12">
    <p class="px-24">No customers found.</p>
</div>

@endif
</div>

<!-- Customer Modal -->
<x-slide-over-modal  x-show="showCustomerModal" max-width="xl" @close-modal="closeCustomerModal()" title="Customer Details" name="customerModal" x-transition>
    <h3 class="text-lg font-medium leading-6 text-gray-900">Payment successful</h3>
    <div class="mt-2 max-w-xl text-sm text-gray-500">
        
    </div>
    <div class="mt-4">
        <span x-text="customer.first_name + ' ' + customer.last_name"></span>
        <button
            type="button"
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            x-on:click="$dispatch('close', 'customerModal')"
        >
            Got it, thanks!
        </button>
    </div>
</x-slide-over-modal>

<script>
    function customerData() {
        console.log("customerData initialized");
        return {
            customers: @json($customers),
            showCustomerModal: true,
            selectedCustomer: null,         
            
            loadData() {
                // Load data from the server
                this.customers = @json($customers);
                
                console.log("Data loaded");
                window.addEventListener('open-modal', (event) => {
                    if (event.detail.name === 'customerModal') {
                       this.selectedCustomer = event.detail.data;
                       this.showCustomerModal = true;
                       console.log('The selected Customer is: ', this.selectedCustomer);
                    }
                });
            },

            openCustomerModal(customer) {
                this.showCustomerModal = true;
                this.selectedCustomer = customer;
                console.log('At the very list 2 things have change: 1: showCustomerModal is (', this.showCustomerModal, ') and selected customer is: ', this.selectedCustomer);
            },

            loadCustomers() {
                // Load meter data from the server
            },

            deleteCustomer(meterId) {
                // Handle meter deletion logic
            },
                    
            closeCustomerModal() {
                console.log("Closing modal");
                this.showCustomerModal = false;
                this.selectedCustomer = null;
            },
        }
    }
</script>