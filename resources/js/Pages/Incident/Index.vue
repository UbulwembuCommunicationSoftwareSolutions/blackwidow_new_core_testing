<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'
import {Inertia} from "@inertiajs/inertia";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Loading from "@/Components/Loading.vue";
import {ref} from "vue";
import debounce from "lodash/debounce";

export default {
    props: [ 'incidents','departments' ],
    components: {
        PrimaryButton,
        AuthenticatedLayout,
        Head,
        Pagination,
        Loading
    },
    data(){
        return {
            filter_by: '',
            sort_by: null,
            sort_desc: false,
            loading : false
        }
    },
    setup(){
        const searchTerm = ref("");
        const debouncedSearch = debounce(e => {
            searchTerm.value = e.target.value;
            console.log(searchTerm.value)
            Inertia.reload({
                data: {
                    search: searchTerm.value
                }
            })
        }, 500)

        return {
            debouncedSearch,
            searchTerm,
        }
    },
    methods: {
        searchTable(){
            this.$inertia.reload({
                data: {
                    search: this.search
                }
            });
        },
        sortTable(field){
            if(this.sort_by === field){
                if(this.sort_desc){
                    this.sort_desc = false;
                }else{
                    this.sort_desc = true;
                }
            }else{
                this.sort_by = field
                this.sort_desc = false;
            }
            this.$inertia.reload({
                data: {
                    sort_by: field,
                    sort_desc : this.sort_desc
                }
            });
        },
        filterTable(field) {
            this.$inertia.reload({
                data: {
                    filter_by: field,
                    filter_value : this.filter_by
                }
            });
        }
    },
    mounted(){
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
                                <p class="mt-2 text-gray-700">A list of all the incidents in your system including their name, title, email and role.</p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-small text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add incident</button>
                            </div>
                        </div>
                        <div class="mt-8 mb-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <div>
                                            <div class="flex flex-row">
                                                <div class="ml-5 mt-5">
                                                    <label for="text" class="block font-small text-gray-700">Search</label>
                                                    <div class="mt-1">
                                                        <input type="text" name="search_by" id="search_by" v-model="searchTerm" @input="debouncedSearch" class="block w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <div class="ml-5 mt-5">
                                                    <label for="text" class="block font-small text-gray-700">Department</label>
                                                    <div class="mt-1">
                                                        <select  v-model="filter_by" v-on:change="filterTable('department')" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option v-for="department in departments">{{department.name}}</option>
                                                            <option value="">None</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <Loading v-if="this.loading"/>
                                            <div class="px-4 sm:px-6 lg:px-8">
                                                <div class="mt-8 flex flex-col">
                                                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                                                <table class="min-w-full table-auto divide-y divide-gray-300">
                                                                    <thead class="bg-gray-50">
                                                                    <tr>
                                                                        <th scope="col"  @click="this.sortTable('id')" class="py-3.5 pl-4 pr-3 text-left font-semibold text-gray-900 ">Id</th>
                                                                        <th scope="col" @click="this.sortTable('name')" class="px-3 py-3.5 w-64 text-left font-semibold text-gray-900">Description</th>
                                                                        <th scope="col"  class="px-3 py-3.5 text-left font-semibold text-gray-900">User</th>
                                                                        <th scope="col"  class="px-3 py-3.5 text-left font-semibold text-gray-900">Department</th>
                                                                        <th scope="col"  class="px-3 py-3.5 text-left font-semibold text-gray-900">Category</th>
                                                                        <th scope="col"  class="px-3 py-3.5 text-left font-semibold text-gray-900">Sub Category</th>
                                                                        <th scope="col"  class="px-3 py-3.5 text-left font-semibold text-gray-900">Sub Sub Category</th>
                                                                        <th scope="col" @click="this.sortTable('created_at')" class="px-3 py-3.5 text-left font-semibold text-gray-900">Date</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody class="bg-white">
                                                                    <tr v-for="(incident,incident_id) in incidents.data" :key="incident.id" :class="incident_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                                        <td class="whitespace-nowrap py-4  text-xs pr-3 font-small text-blue-600 ">
                                                                            <a class="mr-1 mb-1 px-4 py-3 leading-4  rounded  focus:border-indigo-500 focus:text-blue-500"
                                                                                          :href="'/incident/'+incident.id">
                                                                                {{incident.id}}
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-xs text-left w-64 py-4  pr-3 font-small text-blue-600 ">
                                                                            <a class="mr-1 mb-1  px-4 py-3 leading-4  rounded  focus:border-indigo-500 focus:text-blue-500"
                                                                               :href="'/incident/'+incident.id">
                                                                                {{incident.description}}
                                                                            </a>
                                                                        </td>
                                                                        <td class="whitespace-nowrap text-xs px-3 py-4 text-gray-500">{{incident.user.first_name}} {{incident.user.surname}}</td>
                                                                        <td class="whitespace-nowrap text-xs px-3 py-4 text-gray-500">{{ incident.department.name }}</td>
                                                                        <td class="break-words text-xs px-3 py-4 text-gray-500">
                                                                            <b v-if="incident.incident_category!==null">
                                                                                {{ incident.incident_category.name }}
                                                                            </b>
                                                                        </td>
                                                                        <td class="break-words text-xs px-3 py-4 text-gray-500">
                                                                            <b v-if="incident.incident_sub_category!==null">
                                                                                {{ incident.incident_sub_category.name }}
                                                                            </b>
                                                                        </td>
                                                                        <td class="break-words text-xs px-3 py-4 text-gray-500">
                                                                            <b v-if="incident.incident_sub_sub_category!==null">
                                                                                {{ incident.incident_sub_sub_category.name }}
                                                                            </b>
                                                                        </td>

                                                                        <td class="whitespace-nowrap text-xs px-3 py-4 text-gray-500">{{ incident.created_at }}</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="flex mb-6 items-center text-center justify-center">
                                                                <div>
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
            </div>
        </div>

    </AuthenticatedLayout>
</template>
