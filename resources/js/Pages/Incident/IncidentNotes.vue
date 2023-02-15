<template>
    <div class="flex flex-col flex-grow">
        <div v-for="(incident_note,incident_note_id) in incident.incident_notes" class="flex mx-4 my-4 items-center justify-center text-center">
            <div class="rounded-lg w-128 bg-white shadow-lg">
                    <div class="rounded-lg bg-indigo-500 text-white">
                        <h4>
                            {{ incident_note.user.first_name + ' ' + incident_note.user.surname }}
                        </h4>
                        <h6>
                            {{ incident_note.created_at }}
                        </h6>
                    </div>
                    <div class="rounded-t-lg px-4 py-4 sm:px-10 sm:pt-10 sm:pb-8">
                        <div class="relative text-lg font-medium text-gray-700">
                            <div class="w-1/2">
                                <div v-html="sanitize(incident_note.note)" class="relative">
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
