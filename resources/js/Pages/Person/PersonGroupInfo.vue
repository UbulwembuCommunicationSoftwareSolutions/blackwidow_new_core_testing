<template>
    <div class="flex py-4 px-4 mt-4 flex-row flex-grow">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 mt-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">Groups</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all the groups this person belongs to</p>
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
                                        <Loading v-if="this.loading"/>
                                        <div class="px-4 sm:px-6 lg:px-8">
                                            <div class="mt-8 flex flex-col">
                                                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                        <div class="overflow-hidden shadow ring-1 mb-4 ring-black ring-opacity-5 md:rounded-lg">
                                                            <table class="min-w-full mb-4 divide-y divide-gray-300">
                                                                <thead class="bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Id</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Address</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="bg-white">
                                                                <tr v-for="(group,group_id) in person.interest_groups" :key="group_id" :class="group_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                                           :href="'/interest-group/'+group.id">
                                                                            {{group.id}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="break-words py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                                           :href="'/interest-group/'+group.id">
                                                                            {{group.description}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="break-words py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                                           :href="'/interest-group/'+group.id">
                                                                            {{group.address}}
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

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
</template>

<script>
import {PaperClipIcon} from "@heroicons/vue/20/solid";
import NetworkDiagram from "@/Components/NetworkDiagram.vue";
import {ref} from "vue";

export default {
    name: "Page4",
    props : ['person'],
    components: {
        PaperClipIcon
    },
    setup(props){
        return {
            person :props.person
        }
    },
    data(){
        let loading = false;
        return {
            loading
        }

    },
    mounted(){
        console.log(this.person)
    }

}
</script>

<style scoped>

</style>
