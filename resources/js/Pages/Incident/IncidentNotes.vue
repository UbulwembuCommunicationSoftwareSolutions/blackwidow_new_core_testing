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
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Message</th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                            <tr v-for="(incident_note,incident_note_id) in incident.incident_notes" :key="incident_note_id" :class="incident_note_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                <td class="whitespace-nowrap  text-sm font-medium text-blue-600 sm:pl-3">
                                                    <p class="mr-1 mb-1 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500">
                                                        {{incident_note.user.first_name + ' '+ incident_note.user.surname}}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ incident_note.created_at }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="flex mb-6 items-center text-center justify-center">
                                        <div>
                                            <blockquote class="relative rounded-lg bg-white shadow-lg">
                                                <div class="rounded-t-lg px-6 py-8 sm:px-10 sm:pt-10 sm:pb-8">
                                                    <div class="relative mt-8 text-lg font-medium text-gray-700">
                                                        <svg class="absolute top-0 left-0 h-8 w-8 -translate-x-3 -translate-y-2 transform text-gray-200" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                                                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                                                        </svg>
                                                            <p class="relative">
                                                                {{ sanitize(this.incident.incident_notes[i].note) }}
                                                            </p>
                                                            </div>
                                                            </div>
                                                            <cite class="relative flex items-center rounded-b-lg bg-indigo-600 py-5 px-6 not-italic sm:mt-10 sm:items-start sm:py-5 sm:pl-12 sm:pr-10">
                                                          <span class="relative flex-none rounded-full border-2 border-white sm:absolute sm:top-0 sm:-translate-y-1/2 sm:transform">
                                                            <img class="h-12 w-12 rounded-full bg-indigo-300 sm:h-20 sm:w-20" src="https://images.unsplash.com/photo-1500917293891-ef795e70e1f6?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.5&w=160&h=160&q=80" alt="" />
                                                          </span>
                                                            <span class="relative ml-4 font-semibold leading-6 text-indigo-300 sm:ml-24 sm:pl-1">
                                                            <span class="font-semibold text-white sm:inline"> {{ this.incident.incident_notes[i].user.first_name + ' '
                                                            + this.incident.incident_notes[i].user.surname }}</span>
                                                            {{ ' ' }}
                                                            <span class="sm:inline">{{ this.incident.incident_notes[i].created_at }}</span>
                                                          </span>
                                                </cite>
                                            </blockquote>
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
import DOMPurify from 'dompurify'
export default {
    name: "IncidentActivity",
    props : ['incident'],
    components: {
        PaperClipIcon
    },
    setup(props){
        const i = 0;
        const incident = props.incident;
        return{
            incident,i
        }
    },
    mounted(){
        console.log(this.incident.incident_notes)
    },
    methods: {
        sanitize(text) {
            return DOMPurify.sanitize(text);
        },
    }

}
</script>

<style scoped>
</style>
