<template>
    <div class="flex flex-row flex-grow">
        <div class="flex mt-4 py-6 w-full whitespace-nowrap px-6">
            <div class="overflow-hidden w-full bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">People Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Id</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">First Name</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Surname</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Institutions</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                            <tr v-for="(person,person_id) in incident.people" :key="person.id" :class="person_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                <td class="whitespace-nowrap text-sm font-medium text-blue-600 sm:pl-3">
                                                    <a class="mr-1 mb-1 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                       :href="'/person/'+person_id+'/edit'">
                                                        {{person.id}}
                                                    </a>
                                                </td>
                                                <td class="whitespace-nowrap  text-sm font-medium text-blue-600 sm:pl-3">
                                                    <a class="mr-1 mb-1 text-sm  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                       :href="'/person/'+person_id+'/edit'">
                                                        {{person.first_name}}
                                                    </a>
                                                </td>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-3">
                                                    <a class="mr-1 mb-1 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                       :href="'/person/'+person_id+'/edit'">
                                                        {{person.surname}}
                                                    </a>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <p v-for="institute in person.institutions">
                                                        {{institute.description}}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ person.created_at }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="flex mb-6 items-center text-center justify-center">
                                        <div>
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

export default {
    name: "Page2",
    props : ['incident'],
    components: {
        PaperClipIcon
    },

}
</script>

<style scoped>

</style>
