<script>
import DataTable from 'datatables.net-vue3';
import DataTablesLib from 'datatables.net';

DataTable.use(DataTablesLib);

export default {
    name: "CustomDataTable",
    props: [ 'columns','ajaxUrl'],
    setup(props) {
        const columns = props.columns;
        const DateToday = new Date();
        let startDate = new Date(new Date().setDate(DateToday.getDate() - 720)).toISOString().substring(0, 10);
        let endDate = new Date(new Date().setDate(DateToday.getDate() + 1)).toISOString().substring(0, 10);
        let ajaxUrl = props.ajaxUrl;
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
            console.log("Loading Data from "+this.ajaxUrl);
            this.$forceUpdate();  // Notice we have to use a $ here
            $('.dataTable').DataTable( {
                buttons: [
                    'excel'
                ],
                language: {
                    lengthMenu: 'Show _MENU_'
                },
                dom: '<"top"lf>irt<"bottom"p><"clear">'
            } );
            $('.dataTable').DataTable().ajax.url( this.ajaxUrl );
            $('.dataTable').DataTable().rows().clear().draw();
            $('.dataTable').DataTable().ajax.reload();
        },
        reload(){
            this.$forceUpdate();  // Notice we have to use a $ here
            let startTime = document.getElementById('startDate').value;
            let endTime = document.getElementById('endDate').value;
            this.ajaxUrl += '?startTime='+startTime+'&endTime='+endTime;
            $('.dataTable').DataTable().ajax.url( this.ajaxUrl );
            $('.dataTable').DataTable().rows().clear().draw();
            $('.dataTable').DataTable().ajax.reload();
        },
    }
}


</script>

<template>
    <div class="px-4">
        <div class="flex mt-4 mb-4">
            <div>
                <label class="w-32">Start Date:</label>
                <input class="mb-4 ml-2" id="startDate" @input="reload()" type="date" v-model="this.startDate"/>
            </div>
            <div class="ml-4">
                <label class="w-32">End Date:</label>
                <input class="mb-4 ml-2" id="endDate" @input="reload()" type="date" v-model="this.endDate"/>
            </div>
        </div>

        <table class="dataTable mb-4 mt-4 cell-border row-border table-auto display stripe compact px-4"
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

.dataTables_wrapper .dataTables_length select {
    padding-right: 40px;
}

.dataTables_wrapper .dataTables_paginate {
    padding-bottom : .25em;
    text-align : center;
    float : none;
    padding-top : 0;
}
.bottom {
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>
