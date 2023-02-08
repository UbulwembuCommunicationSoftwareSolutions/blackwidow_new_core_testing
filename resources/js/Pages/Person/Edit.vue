<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from "@inertiajs/inertia-vue3";
// import the styles
import Page1 from  "@/Pages/Person/Page1.vue";
import Page2 from  "@/Pages/Person/Page2.vue";
export default {
    components: {
        AuthenticatedLayout,
        Head,
        Page1,
        Page2,
    },
    props:{
        person :  Object,
        available_institutions : Array,
        person_institutions : Array,
        permissions : Array,
    },
    setup(props){
        const tabs = [
            { name: 'Basic Information', tab: 1, current: true },
            { name: 'Persons of interest', tab: 2, current: false },
            { name: 'Case Notes', tab: 3, current: false },
            { name: 'Case Activity', tab: 4,current: false },
        ]
        let person = props.person;
        let available_institutions = props.available_institutions;
        let person_institutions = props.person_institutions;
        let permissions = props.permissions;
        return {
            permissions,tabs,person,available_institutions,person_institutions
        }
    },
    data(){
        return {
            displayPage : 1,
        }
    },
    mounted(){
    },
    methods:{
        adminPanel(){
            window.location.href = '/admin';
        },
        loadTab(id){
            this.displayPage = (id +1);
            this.tabs.forEach((tab) => {
                if(tab.tab === this.displayPage ){
                    tab.current = true;
                }else{
                    tab.current = false;
                }
            });
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<template>
    <Head title="Person of Interest" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Person of Interest
            </h2>
        </template>
        <div
            v-if="$page.props.flash.success"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
                    <span class="font-medium">
                        {{ $page.props.flash.success }}
                    </span>
        </div>
        <div :key="this.displayPage">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 mt-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <div>
                                    <div class="max-w-7xl mx-auto">
                                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="px-4 mt-4 sm:px-6 lg:px-8">
                                                <div class="sm:hidden">
                                                    <label for="tabs" class="sr-only"></label>
                                                    <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                                                    <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                                        <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
                                                    </select>
                                                </div>
                                                <div class="hidden sm:block">
                                                    <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
                                                        <a v-for="(tab, tabIdx) in tabs" :key="tab.name"
                                                           v-on:click="loadTab(tabIdx)"
                                                           :class="[tab.current ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700',
                                        tabIdx === 0 ? 'rounded-l-lg' : '',
                                        tabIdx === tabs.length - 1 ? 'rounded-r-lg' : '',
                                         'group relative min-w-0 flex-1 overflow-hidden' +
                                          ' bg-white py-4 px-4 text-sm font-medium' +
                                           ' text-center hover:bg-gray-50 focus:z-10']" :aria-current="tab.current ? 'page' : undefined">
                                                            <span>{{ tab.name }}</span>
                                                            <span aria-hidden="true" :class="[tab.current ? 'bg-indigo-500' : 'bg-transparent', 'absolute inset-x-0 bottom-0 h-0.5']" />
                                                        </a>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="this.displayPage===1" id="page_1">
                        <Page1
                            :person="this.person"
                            :available_institutions="this.available_institutions"
                            :person_institutions="this.person_institutions"
                            :permissions="this.permissions"
                        />
                    </div>
                    <div v-if="this.displayPage===2" id="page_2">
                        <Page2
                        :person="this.person"
                        />
                    </div>
                </div>
            </div>
        </div>>
    </AuthenticatedLayout>
</template>
