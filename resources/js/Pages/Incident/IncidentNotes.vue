<template>
    <div class="flex mt-10 flex-row flex-grow">
        <div class="flex basis-1/2 mx-2 whitespace-nowrap ">
            <div class="overflow-hidden w-full bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Incident Notes</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden mt-4 mb-4 shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                            <tr v-for="(incident_note,incident_note_id) in incident.incident_notes" :key="incident_note_id" :class="incident_note_id !== i ? undefined : 'bg-gray-200'">
                                                <td @click="changeNote(incident_note_id)" class="whitespace-nowrap  text-sm font-medium text-gray-600 sm:pl-3">
                                                    <p class="mr-1 mb-1 text-sm leading-4  rounded">
                                                        {{incident_note.user.first_name + ' '+ incident_note.user.surname}}
                                                    </p>
                                                </td>
                                                <td  @click="changeNote(incident_note_id)" class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
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

                </div>
            </div>
        </div>
        <div class="flex basis-1/2 h-96 mx-2 items-center text-center">
            <div class="rounded-lg h-96 bg-white shadow-lg">
                    <div class="rounded-lg bg-indigo-500 text-white">
                        <h4>
                            {{ this.incident.incident_notes[i].user.first_name + ' '
                    + this.incident.incident_notes[i].user.surname }}
                        </h4>
                        <h6>
                            {{ this.incident.incident_notes[i].created_at }}
                        </h6>
                    </div>
                    <div class="rounded-t-lg px-6 py-8 sm:px-10 sm:pt-10 sm:pb-8">
                        <div class="relative mt-8 text-lg font-medium text-gray-700">
                            <div class="w-96">
                                <div v-html="sanitize(this.incident.incident_notes[i].note)" class="relative">
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
            return text.replace(/<[^>]*>?/gm, '');
        },
        changeNote(incident_note_id){
            this.i = incident_note_id;
        }
    }

}
</script>

<style scoped>
</style>
