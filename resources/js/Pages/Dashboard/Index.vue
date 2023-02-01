<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'
import Loading from "@/Components/Loading.vue";
import UserIncidents from "@/Pages/Dashboard/UserIncidents.vue";
import UserStats from "@/Pages/Dashboard/UserStats.vue";

export default {
    props: ['my_incident_stats','markers'],
    components: {
        UserStats,
        AuthenticatedLayout,
        Head,
        Pagination,
        UserIncidents,
        Loading
    },
    setup(props){
       let  my_incident_stats = props.my_incident_stats;
       let  markers = props.markers;
       return {
            my_incident_stats,
            markers
        }
    },
    mounted(){
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 shadow-sm rounded-lg lg:px-8 border-b border-gray-200">
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="bg-white">
                        <UserIncidents :markers="this.markers"></UserIncidents>
                        <UserStats :my_incident_stats="this.my_incident_stats"></UserStats>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
