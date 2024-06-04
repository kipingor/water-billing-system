@props(['data', 'headers', 'actions' => [], 'sortColumn' => '', 'sortDirection' => 'asc'])

<div x-data="dynamicTableData()" x-init="loadData()">
    <div class="flex justify-between mb-4">
        <div>
            <input type="text" id="searchTerm" x-model="searchTerm" placeholder="Search..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <button type="button" @click="sortBy('{{ $header['key'] }}')" class="px-2 py-1 rounded-md hover:bg-gray-100 focus:outline-none text-xs font-medium text-gray-500 uppercase focus:bg-gray-100 focus:text-gray-700">
                                {{ $header['label'] }}
                                <span x-show="sortColumn === '{{ $header['key'] }}'">
                                    <span x-show="sortDirection === 'asc'">&#9652;</span>
                                    <span x-show="sortDirection === 'desc'">&#9662;</span>
                                </span>
                            </button>                            
                        </th>
                    @endforeach
                    @if(!empty($actions))
                        <th scope="col" class="px-6 py-3 bg-gray-50"></th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="item in filteredData" :key="item.id">
                    <tr class="odd:bg-white even:bg-slate-50">
                        @foreach($headers as $header)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item['{{ $header['key'] }}']"></td>
                        @endforeach
                        @if(!empty($actions))
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @foreach($actions as $action)
                                    <button @click="$event.preventDefault(); $event.stopPropagation(); {{ $action['handler'] }}(item)" class="{{ $action['class'] }}">{{ $action['label'] }}</button>
                                @endforeach
                            </td>
                        @endif
                    </tr>
                </template>
            </tbody>
        </table>
        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <button type="button" @click="previousPage()" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
                <button type="button" @click="nextPage()" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
            </div>
            <div class="sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium" x-text="currentPage"></span>
                        to
                        <span class="font-medium" x-text="totalPages"></span>
                        of
                        <span class="font-medium" x-text="data.length"></span>
                        results
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <button type="button" @click="previousPage()" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <template x-for="pageNumber in generatePageNumbers()" :key="pageNumber">
                            <button type="button" :class="{ 'bg-indigo-600 text-white': pageNumber === currentPage, 'text-gray-900': pageNumber !== currentPage }" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" x-text="pageNumber" @click.prevent="viewPage(pageNumber)"></button>
                        </template>
                        <button type="button" @click="nextPage()" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dynamicTableData() {
        return {
            data: @js($data),
            searchTerm: '',
            sortColumn: @js($sortColumn),
            sortDirection: @js($sortDirection),
            currentPage: 1,
            itemsPerPage: 10,
            totalPages: 1,

            loadData() {
                this.filteredData = this.data;
                this.totalPages = Math.ceil(this.data.length / this.itemsPerPage);
            },

            get filteredData() {
                let filtered = this.data;

                if (this.searchTerm) {
                    filtered = filtered.filter(item => {
                        return Object.values(item).some(value => {
                            if (typeof value === 'string') {
                                return value.toLowerCase().includes(this.searchTerm.toLowerCase());
                            }
                            return false;
                        });
                    });
                }

                filtered.sort((a, b) => {
                    const sortOrder = this.sortDirection === 'asc' ? 1 : -1;
                    if (a[this.sortColumn] < b[this.sortColumn]) return -1 * sortOrder;
                    if (a[this.sortColumn] > b[this.sortColumn]) return 1 * sortOrder;
                    return 0;
                });

                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                this.totalPages = Math.ceil(filtered.length / this.itemsPerPage);
                return filtered.slice(start, end);
            },

            nextPage() {
                if ((this.currentPage * this.itemsPerPage) < this.data.length) this.currentPage++;
            },

            previousPage() {
                if (this.currentPage > 1) this.currentPage--;
            },

            viewPage(pageNumber) {
                if (pageNumber >= 1 && pageNumber <= this.totalPages) {
                    this.currentPage = pageNumber;
                }
            },

            // generatePageNumbers() {
            //     return Array.from({ length: this.totalPages }, (_, index) => index + 1);
            // },

            generatePageNumbers() {
                const pages = [];
                if (this.totalPages <= 10) {
                    // If total pages are 10 or less, show all pages
                    for (let i = 1; i <= this.totalPages; i++) {
                        pages.push(i);
                    }
                } else {
                    // More than 10 pages, show according to the rules
                    const startPages = [1, 2];
                    const endPages = [this.totalPages - 1, this.totalPages];
                    const current = this.currentPage;

                    if (current < 5) {
                        // Current page is among the first three
                        pages.push(...startPages, 3, 4, 5, 6, '...', ...endPages);
                    } else if (current >= 5 && current < this.totalPages - 4) {
                        // Current page is somewhere in the middle
                        pages.push(...startPages, '...', current - 1, current, current + 1, '...', ...endPages);
                    } else {
                        // Current page is among the last three
                        pages.push(...startPages, '...', this.totalPages - 5, this.totalPages - 4, this.totalPages - 3, ...endPages);
                    }
                }
                return pages;
            },

            sortBy(column) {
                if (this.sortColumn === column) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortColumn = column;
                    this.sortDirection = 'asc';
                }
            },
            init() {
                this.loadData();
            }
        }
    }
</script>