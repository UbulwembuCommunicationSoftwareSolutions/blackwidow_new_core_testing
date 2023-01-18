<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from "@inertiajs/inertia-vue3";
import Treeselect from 'vue3-treeselect'
// import the styles
import 'vue3-treeselect/dist/vue3-treeselect.css'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Treeselect
    },
    props:{
        department :  Object,
        institutions : Array,
    },
    setup(props){
        const form = useForm({
            department : props.department,
        });
        return {
            form
        }
    },
    data(){
        return {
            selected: null,
        }
    },
    mounted(){
    },
    methods:{
        adminPanel(){
            window.location.href = '/admin';
        },
        submitDepartmentForm(){
            this.form.put(route("department.update", this.form.department.id));
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<template>
    <Head title="Department" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Department
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:py-6 lg:py-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <div class="mt-10 ml-8 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg  mt-10 font-medium leading-6 text-gray-900">Department Information</h3>
                        <p class="mt-1 text-sm text-gray-600"></p>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form @submit.prevent="submitDepartmentForm()" method="POST">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="description" class="block text-sm font-medium text-gray-700">First name</label>
                                        <input v-model="form.department.description" type="text" name="description" id="description" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="col-span-6">
                                        <treeselect id="institution" v-model="form.department.institution_id" :multiple="false" :options="props.institutions" />
                                    </div>

                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                            </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>
        </div>

        </div>
        </div>

    </AuthenticatedLayout>
</template>
