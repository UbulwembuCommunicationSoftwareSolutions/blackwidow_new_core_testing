<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'
import {Inertia} from "@inertiajs/inertia";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    props: [ 'incidents' ],
    components: {
        PrimaryButton,
        AuthenticatedLayout,
        Head,
        Pagination
    },
    data(){
        return {
            search: '',
            selectedFilter: 'all',
            sortBy: null,
            sortDesc: false,
            loading : false
        }
    },
    methods: {
        searchTable(){
            this.$inertia.reload({
                data: {
                    search: this.search
                }
            });
        }
    },
    mounted(){
        console.log(this.incidents);
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

        <div>
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 mt-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-xl font-semibold text-gray-900">Incidents</h1>
                                <p class="mt-2 text-sm text-gray-700">A list of all the incidents in your system including their name, title, email and role.</p>
                            </div>
                            <div>

                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add incident</button>
                            </div>
                        </div>
                        <div class="mt-8 mb-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <div>
                                            <div class="ml-5 mt-5">
                                                <label for="text" class="block text-sm font-medium text-gray-700">Search</label>
                                                <div class="mt-1">
                                                    <input type="text" name="text" id="text" v-model="search" @input="this.searchTable" class="block w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm" placeholder="Search" />
                                                </div>
                                            </div>
                                            <Loading v-if="this.loading"/>
                                            <div class="px-4 sm:px-6 lg:px-8">
                                                <div class="mt-8 flex flex-col">
                                                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                                                <table class="min-w-full divide-y divide-gray-300">
                                                                    <thead class="bg-gray-50">
                                                                    <tr>
                                                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Id</th>
                                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Department</th>
                                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                                            <span class="sr-only">Edit</span>
                                                                        </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody class="bg-white">
                                                                    <tr v-for="(incident,incident_id) in incidents.data" :key="incident.id" :class="incident_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                                            <inertia-link class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                                                                                          :href="'/incident/'+incident.id">
                                                                                {{incident.id}}
                                                                            </inertia-link>

                                                                        </td>
                                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ incident.description }}</td>
                                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ incident.department.description }}</td>
                                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ incident.created_at }}</td>
                                                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                                                            >Edit<span class="sr-only"> Edit </span></a
                                                                            >
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <Pagination class="mt-6" :links="incidents.links" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
