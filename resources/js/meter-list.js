document.addEventListener('alpine:init', () => {
    Alpine.data('meterList', () => ({
        meters: [], // Replace with your meter data
        searchTerm: '',
        sortColumn: 'meter_number',
        sortDirection: 'asc',

        filteredMeters() {
            let filtered = this.meters;

            if (this.searchTerm) {
                filtered = filtered.filter(meter =>
                    meter.meter_number.toLowerCase().includes(this.searchTerm.toLowerCase())
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
                this.sortDirection = 'asc';
            }
        },

        loadMeters() {
            // Load meter data from the server
        },

        deleteMeter(meterId) {
            // Handle meter deletion logic
        },
    }));
});