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
                                            <tr v-for="(incident_note,incident_note_id) in incident.incident_notes" :key="incident_note_id" :class="incident_note_id === i ? undefined : 'bg-gray-500'">
                                                <td @click="changeNote(incident_note_id)" class="whitespace-nowrap  text-sm font-medium text-blue-600 sm:pl-3">
                                                    <p class="mr-1 mb-1 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500">
                                                        {{incident_note.user.first_name + ' '+ incident_note.user.surname}}
                                                    </p>
                                                </td>
                                                <td  @click="changeNote(incident_note_id)" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ incident_note.created_at }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex my-6 mx-6 items-center text-center justify-center">
                        <div>
                            <blockquote class="relative rounded-lg bg-white shadow-lg">
                                <div class="rounded-t-lg px-6 py-8 sm:px-10 sm:pt-10 sm:pb-8">
                                    <div class="relative mt-8 text-lg font-medium text-gray-700">
                                        <div class="w-96">
                                            <div v-html="sanitize(this.incident.incident_notes[i].note)" class="relative">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <cite class="relative flex items-center rounded-b-lg bg-indigo-600 py-5 px-6 not-italic sm:mt-10 sm:items-start sm:py-5 sm:pl-12 sm:pr-10">
                                    <span class="relative ml-4 font-semibold leading-6 text-indigo-300 sm:ml-24 sm:pl-1">
                                            <span class="font-semibold text-white sm:inline">
                                                {{ this.incident.incident_notes[i].user.first_name + ' '
                                            + this.incident.incident_notes[i].user.surname }}
                                            </span>
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
        const incident = props.incident;
        return{
            incident
        }
    },
    data(){
        let i = 0;
        return {
            i
        }
    },
    mounted(){
        console.log(this.incident.incident_notes)
    },
    methods: {
        sanitize(text) {
            let new_text = '<div class="w-96">'+text
            new_text = new_text + '</div>';
            console.log(text);
            console.log(new_text);
            return DOMPurify.sanitize(new_text);
        },
        changeNote(incident_note_id){
            this.i = incident_note_id;
        }
    }

}
</script>

<style scoped>
</style>
