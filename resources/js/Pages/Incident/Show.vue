<template>
    <Head title="Incident" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Persons of Interest
            </h2>
        </template>

        <div>
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
                    <Page1 :incident="this.incident" v-if="this.currentpage===1"/>
                    <Page2 :incident="this.incident" v-if="this.currentpage===2"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Page1 from '@/Pages/Incident/Page1.vue';
import Page2 from '@/Pages/Incident/Page2.vue';

export default {
    components: {
        Page1,
        Page2,
        AuthenticatedLayout,
        Head,
    },
    props:{
        incident :  Object,
        currentpage : null
    },
    setup(props){
        let incident = props.incident
        let currentpage = props.currentpage

        const tabs = [
            { name: 'Basic Information', tab: 1, current: false },
            { name: 'Persons of interest', tab: 2, current: false },
            { name: 'Case Notes', tab: 3, current: false },
            { name: 'Case Activity', tab: 4,current: false },
        ]
        tabs.forEach((tab) => {
            if(tab.tab == currentpage ){
                console.log("Current tab is "+currentpage)
                tab.current = true;
            }
        });
        return {
            tabs,incident,currentpage
        }
    },
    methods: {
        loadTab(id){
            console.log(id);
            let currentpage = id+1;
            this.$inertia.reload({
                data: {
                    currentpage: currentpage
                }
            });
        },

    },
}


</script>
