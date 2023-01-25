<template>
    <div>
        <Loading v-if="this.loading"/>
        <input v-model="search" @input="this.searchTable()" placeholder="Search" />
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
                                            <th v-for="(column, key) in this.columns">{{ column.toUpperCase() }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="item in this.returned_data" :key="item.id">
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
import { ref } from 'vue';
import { TailwindPagination } from 'laravel-vue-pagination';

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
            loading : false
        }
    },
    setup(props){

        const laravelData = ref({});
        let columns = props.columns;
        let ajaxUrl = props.ajaxUrl;
        return {
            columns,ajaxUrl
        }
    },
    computed: {

    },
    mounted() {
        this.getData()
    },
    methods: {
        getData(page = undefined,search = undefined){
            this.loading = true;
            let ajaxUrl = this.ajaxUrl;
            if(page!==undefined){
                ajaxUrl += '?page='+page
            }
            if(search!==undefined){
                ajaxUrl += '&search='+search
            }
            axios.get(ajaxUrl)
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
