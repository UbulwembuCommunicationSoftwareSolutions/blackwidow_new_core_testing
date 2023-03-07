<template>
    <div class="flex flex-row flex-grow">
        <div class="flex mt-4 py-6 w-full whitespace-nowrap px-6">
            <div class="overflow-hidden w-full bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Incident Activity</h3>
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
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Note</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Message</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">name</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                            <tr v-for="(incident_activity,incident_activity_id) in incident.incident_activities" :key="incident_activity_id" :class="incident_activity_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                <td class="whitespace-nowrap text-sm font-medium text-blue-600 sm:pl-3">
                                                    <p class="mr-1 mb-1 text-sm leading-4  rounded ">
                                                        {{incident_activity.note}}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap  text-sm font-medium text-blue-600 sm:pl-3">
                                                    <p class="mr-1 mb-1 text-sm leading-4  rounded ">
                                                        {{incident_activity.user.first_name + ' '+ incident_activity.user.surname}}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-3">
                                                    <p class="mr-1 mb-1 text-sm leading-4  rounded ">
                                                        {{incident_activity.message}}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <p class="mr-1 mb-1 text-sm leading-4  rounded ">
                                                        {{incident_activity.name}}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ incident_activity.created_at }}
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
    name: "IncidentActivity",
    props : ['incident'],
    components: {
        PaperClipIcon
    },
    setup(props){
        const incident = props.incident;
        return{
            incident
        }
    },
    mounted(){
        console.log(this.incident.incident_activities)
    }

}
</script>

<style scoped>

</style>
