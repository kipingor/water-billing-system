document.addEventListener('alpine:init', () => {
    Alpine.data('customerList', () => ({
        customers: [], // Replace with your customer data
        searchTerm: '',
        sortColumn: 'name',
        sortDirection: 'asc',

        filteredCustomers() {
            let filtered = this.customers;

            if (this.searchTerm) {
                filtered = filtered.filter(customer =>
                    customer.name.toLowerCase().includes(this.searchTerm.toLowerCase())
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
    }));
});