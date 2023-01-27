<template>
    <Head title="Incident" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Incident
            </h2>
        </template>
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
                                       onclick="this.changeTab(tab.id)"
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
    </AuthenticatedLayout>

</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
    },
    props:{
        incident :  Object
    },
    setup(props){
        const tabs = [
            { name: 'Applied', href: '#', id: '1', current: false },
            { name: 'Phone Screening', href: '#', id: '2', current: false },
            { name: 'Interview', href: '#', id: '3', current: true },
            { name: 'Offer', href: '#', id: '4',current: false },
            { name: 'Disqualified', id :'5', href: '#', current: false },
        ]
        let incident = props.incident
        return {
            tabs,incident
        }
    },
    methods: {
        changeTab(id){
            this.tabs.forEach((tab) => {
                tab.current = false;
                if(tab.id===id){
                    tab.current = true;
                }
            });
        }
    }
}


</script>
