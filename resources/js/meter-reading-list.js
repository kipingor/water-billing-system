document.addEventListener('alpine:init', () => {
    Alpine.data('meterReadingList', () => ({
        meterReadings: [], // Replace with your meter reading data
        searchTerm: '',
        sortColumn: 'reading_date',
        sortDirection: 'desc',

        filteredMeterReadings() {
            let filtered = this.meterReadings;

            if (this.searchTerm) {
                filtered = filtered.filter(meterReading =>
                    meterReading.meter.meter_number.toLowerCase().includes(this.searchTerm.toLowerCase())
                );
            }

            filtered.sort((a, b) => {
                const sortOrder = this.sortDirection === 'asc' ? 1 : -1;
                if (a[this.sortColumn] < b[this.sortColumn]) return -1 * sortOrder;
                if (a[this.sortColumn] > b[this.sortColumn]) return 1 * sortOrder;
                return 0;
            });

            return filtered;
        },

        sortBy(column) {
            if (this.sortColumn === column) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortColumn = column;
                this.sortDirection = 'desc';
            }
        },
    }));
});