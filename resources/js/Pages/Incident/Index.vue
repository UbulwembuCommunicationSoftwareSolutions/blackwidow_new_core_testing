<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import CustomDataTable from '@/Components/CustomDataTable.vue';


export default {
    components: {
        AuthenticatedLayout,
        Head,
        CustomDataTable
    },
    setup(props){
        const columns = [
            {data: 'id'},
            {data: 'description'},
        ];
        const ajaxUrl = '/ajax/incidents';

        return{
            columns,ajaxUrl
        }
    },
    props:{
        incidents :  Object
    }
}
</script>

<template>
    <Head title="Incident" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Incidents
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:py-6 lg:py-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 mt-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-xl font-semibold text-gray-900">Incidents</h1>
                                <p class="mt-2 text-sm text-gray-700">A list of all the incidents in your system including their name, title, email and role.</p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add incident</button>
                            </div>
                        </div>
                        <div class="mt-8 mb-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <CustomDataTable :columns="this.columns" :ajaxurl="this.ajaxUrl">

                                        </CustomDataTable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
