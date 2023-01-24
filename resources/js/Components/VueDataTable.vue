<template>
    <div>
        <input v-model="search" placeholder="Search" />
        <select v-model="selectedFilter">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">Incidents</h1>
                        <p class="mt-2 text-sm text-gray-700"></p>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Add Incident</button>
                    </div>
                </div>
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th v-for="(column) in this.columns" @click="sortBy(column)">{{ column }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="item in filteredItems" :key="item.id">
                                            <td v-for="(value, key) in item" :key="key">{{value}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: "CustomDataTable",
    props: [ 'columns','ajaxUrl'],
    data() {
        return {
            returned_data : null,
            search: '',
            selectedFilter: 'all',
            sortBy: null,
            sortDesc: false
        }
    },
    setup(props){
        let columns = props.columns;
        let ajaxUrl = props.ajaxUrl;
        return {
            columns,ajaxUrl
        }
    },
    computed: {
        filteredItems() {
            let filtered = this.returned_data
            if (this.search) {
                filtered = filtered.filter(obj => {
                    return Object.entries(obj).some(entry => entry.toLowerCase().includes(this.search.toLowerCase()));
                });
            }
            if (this.selectedFilter !== 'all') {
                filtered = filtered.filter(item => {
                    return item.status === this.selectedFilter
                })
            }
            if (this.sortBy) {
                filtered = filtered.sort((a, b) => {
                    if (a[this.sortBy] < b[this.sortBy]) {
                        return this.sortDesc ? 1 : -1
                    }
                    if (a[this.sortBy] > b[this.sortBy]) {
                        return this.sortDesc ? -1 : 1
                    }
                    return 0
                })
            }
            return filtered
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        sortBy(sortBy) {
            if (this.sortBy === sortBy) {
                this.sortDesc = !this.sortDesc
            } else {
                this.sortBy = sortBy
                this.sortDesc = false
            }
        },
        getData(){
            axios.get(this.ajaxUrl)
                .then((res) => {
                    this.returned_data = res.data;
                })
                .catch((error) => {

                }).finally(() => {

                }
            );
        },
    }
}
</script>
