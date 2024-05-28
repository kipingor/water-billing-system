<div x-data="meterList()">
    @if ($meters->count() > 0)    

    <x-table
    :data="$meters"
    :headers="[
        ['key' => 'meter_number', 'label' => 'Meter Number'],
        ['key' => 'customer', 'label' => 'Customer'],
        ['key' => 'location', 'label' => 'Meter Location'],
        ['key' => 'meter_type', 'label' => 'Meter Type'],
        ['key' => 'meter_status', 'label' => 'Meter Status'],
    ]"
    :sortColumn="'customer'"
    :sortDirection="'asc'"
></x-table>
</div>
@else
<div class="flex justify-between mb-4 mx-auto px-12">
    <p class="px-24">No meters found.</p>
</div>

@endif
</div>
<script>
function meterList() {
    return {
        meters: @json($meters),
    }
}
</script>