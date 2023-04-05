<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'
import Loading from "@/Components/Loading.vue";
import UserIncidents from "@/Pages/Dashboard/UserIncidents.vue";
import UserStats from "@/Pages/Dashboard/UserStats.vue";

export default {
    props: ['incident_stats','markers','departments','is_admin'],
    components: {
        UserStats,
        AuthenticatedLayout,
        Head,
        Pagination,
        UserIncidents,
        Loading
    },
    setup(props){
        let  incident_stats = props.incident_stats;
        let  markers = props.markers;
        let departments = props.departments;
        return {
            incident_stats,
            markers,
            departments
        }
    },
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
                        <UserStats :departments="this.departments" :incident_stats="this.incident_stats"></UserStats>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
