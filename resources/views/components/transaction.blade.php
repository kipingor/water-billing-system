<div>
    @if (count($transactions) > 0)    

    <x-table
        :data="$transactions"
        :headers="[
            ['key' => 'type', 'label' => 'Type'],
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'amount', 'label' => 'Amount'],
            ['key' => 'id', 'label' => 'id'],
        ]"        
        :sortColumn="'date'"
        :sortDirection="'desc'"
    ></x-table>
    @else
    <div class="flex justify-between mb-4 mx-auto px-12">
        <p class="px-24">No Transactions found.</p>
    </div>
    
    @endif
</div>