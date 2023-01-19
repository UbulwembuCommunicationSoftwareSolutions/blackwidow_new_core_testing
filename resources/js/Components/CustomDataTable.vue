<script>
import DataTable from 'datatables.net-vue3';

export default {
    name: "CustomDataTable",
    props: [ 'columns','ajaxurl'],
    setup(props) {
        const columns = props.columns;
        const DateToday = new Date();
        let startDate = new Date(new Date().setDate(DateToday.getDate() - 720)).toISOString().substring(0, 10);
        let endDate = new Date(new Date().setDate(DateToday.getDate() + 1)).toISOString().substring(0, 10);
        let ajaxUrl = props.ajaxurl;
        return {
            columns,ajaxUrl,startDate,endDate
        }
    },mounted(){
        this.loadData();
    },

    components: {
        DataTable
    },
    methods: {
        loadData(){
            console.log("Loading Data");
            this.$forceUpdate();  // Notice we have to use a $ here
            let dataTable = $('.dataTable');
            dataTable.DataTable( {
                buttons: [
                    'excel'
                ]
            } );
            dataTable.DataTable().ajax.url( this.ajaxUrl );
            dataTable.DataTable().rows().clear().draw();
            dataTable.DataTable().ajax.reload();
        },
        reload(){
            this.$forceUpdate();  // Notice we have to use a $ here
            let dataTable = $('.dataTable');
            dataTable.DataTable().ajax.url( this.ajaxUrl );
            dataTable.DataTable().rows().clear().draw();
            dataTable.DataTable().ajax.reload();
        },
    }
}


</script>

<template>
    <div>
        <div class="flex-col">
            <div class="flex">
                <label class="w-32">Start Date:</label>
                <input class="mb-4" id="startDate" @input="reload()" type="date" v-model="this.startDate"/>
            </div>
            <div class="flex">
                <label class="w-32">End Date:</label>
                <input class="mb-4" id="endDate" @input="reload()" type="date" v-model="this.endDate"/>

            </div>
        </div>

        <table class="dataTable display mt-4"
            id="dataTable"
            >
        <thead>
            <tr>
                <th v-for="(column) in this.columns">
                    {{column}}
                </th>
            </tr>
        </thead>
        </table>
    </div>
</template>

<style>
@import 'datatables.net-dt';
</style>
