<template>
    <div>
        <input v-model="search" placeholder="Search" />
        <select v-model="selectedFilter">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <table>
            <thead>
            <tr>
                <th v-for="(column) in this.columns" @click="sortBy(column)">{{ column }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in filteredItems" :key="item.id">
                <td v-for="(value, key) in item" :key="key">{{value}}</td>
            </tr>
            </tbody>
        </table>
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
                filtered = filtered.filter(item => {
                    return item.description.toLowerCase().includes(this.search.toLowerCase())
                })
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
                    console.log(res.data);
                    console.log(this.returned_data);
                    console.log(this.filteredItems);

                })
                .catch((error) => {

                }).finally(() => {

                }
            );
        },
    }
}
</script>
