<template>
    <div>
        <Loading v-if="this.loading"/>
        <input v-model="search"  placeholder="Search" />
        <select v-model="selectedFilter">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th v-for="(column, key) in this.columns" @click="sortBy(column)">{{ column.toUpperCase() }}</th>
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
import Loading from '@/Components/Loading.vue';

export default {
    name: "CustomDataTable",
    components: {Loading},
    props: [ 'columns','ajaxUrl'],
    data() {
        return {
            returned_data : null,
            search: '',
            selectedFilter: 'all',
            sortBy: null,
            sortDesc: false,
            loading : true
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
                    return Object.values(obj).some(val => {
                        return (typeof val === 'string' && val.includes(this.search))
                    });
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
            this.loading = false;
            return filtered
        }
    },
    mounted() {
        this.getData()
    },
    watch: {
        filteredItems: function () {
           this.loading = true;
        }
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
            this.loading = true;
            axios.get(this.ajaxUrl)
                .then((res) => {
                    this.returned_data = res.data;
                    this.loading = false;

                })
                .catch((error) => {

                }).finally(() => {

                }
            );
        },
    }
}
</script>
