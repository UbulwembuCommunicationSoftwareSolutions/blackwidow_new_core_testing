<template>
    <div class="flex py-4 px-4 mt-4 flex-row flex-grow">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 mt-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">Incidents</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all the incidents in your system including their name, title, email and role.</p>
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
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">name</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Department</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">People</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="bg-white">
                                                                <tr v-for="(incident,incident_id) in this.incidents" :key="incident.id" :class="incident_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded "
                                                                           :href="'/incident/'+incident.id">
                                                                            {{incident.id}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="break-words py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded "
                                                                           :href="'/incident/'+incident.id">
                                                                            {{incident.name}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{incident.user.first_name}} {{incident.user.surname}}</td>
                                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ incident.department.name }}</td>
                                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ incident.created_at }}</td>
                                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded "
                                                                           :href="'/incident/'+incident.id">
                                                                            {{incident.people_count}}
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
    <div class="flex py-2 px-2 flex-row flex-grow">
        <div class="flex px-4 mb-4 flex-row flex-grow">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 mt-4 sm:px-6 lg:px-8">
                        <div class="mt-8 mb-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden mb-6 shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <div>
                                            <Loading v-if="this.loading"/>
                                            <div class="px-4 sm:px-6 lg:px-8">
                                                <div class="mt-8 flex flex-col">
                                                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                                                <NetworkDiagram
                                                                    :nodes = "this.nodes"
                                                                    :edges = "this.edges"
                                                                />

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
    </div>

</template>

<script>
import {PaperClipIcon} from "@heroicons/vue/20/solid";
import NetworkDiagram from "@/Components/NetworkDiagram.vue";
import {ref} from "vue";

export default {
    name: "Page3",
    props : ['person','incidents'],
    components: {
        NetworkDiagram,
        PaperClipIcon
    },
    setup(props){
        return {
            incidents : props.incidents,
            person :props.person
        }
    },
    data(){
        let loading = false;
        let temp_nodes = {};
        let edges = {};
        let layoutNodes = {};


        this.incidents.map((incident, index) => {
            temp_nodes[`incident${incident.id}`] = { name: 'Case: '+incident.id };
            edges[`incident${incident.id}`] = { source: `incident${incident.id}` , target: `person${this.person.id}` }
        });


        this.incidents.forEach((incident) => {
            temp_nodes[`incident${incident.id}`] = {name: 'Incident: ' + incident.id};

            incident.people.forEach((person) => {
                if(person.id!==this.person.id){
                    temp_nodes[`person${person.id}`] = {name: 'Person: ' + person.id + ' '+person.first_name+ '' + person.surname};
                    edges[`person${person.id}`] = {source: `incident${incident.id}`, target: `person${person.id}`}
                }
            });
        });
        temp_nodes[`person${this.person.id}`] = {
            name: 'Person: '+ +this.person.id+' \n '+this.person.first_name+ '' + this.person.surname,
            type: "circle",
            radius: 16,
            // for type is "rect" -->
            width: 32,
            height: 32,
            borderRadius: 4,
            // <-- for type is "rect"
            strokeWidth: 0,
            strokeColor: "#000000",
            strokeDasharray: "0",
            color: "#4466cc",
        };
        layoutNodes[`person${this.person.id}`] = {
            x: 0,
            y: 0,
            fixed: true, // Unaffected by force
        };

        let nodes = temp_nodes;
        let layouts = {
            nodes: layoutNodes
        }

        return {
            edges,nodes,loading,layouts
        }

    },
    mounted(){
        console.log(this.layouts);
    }

}
</script>

<style scoped>

</style>
