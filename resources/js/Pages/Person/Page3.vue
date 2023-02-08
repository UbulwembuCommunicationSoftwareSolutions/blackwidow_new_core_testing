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
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Department</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">People</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="bg-white">
                                                                <tr v-for="(incident,incident_id) in this.incidents" :key="incident.id" :class="incident_id % 2 === 0 ? undefined : 'bg-gray-50'">
                                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                                           :href="'/incident/'+incident.id">
                                                                            {{incident.id}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
                                                                           :href="'/incident/'+incident.id">
                                                                            {{incident.description}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{incident.user.first_name}} {{incident.user.surname}}</td>
                                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ incident.department.description }}</td>
                                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ incident.created_at }}</td>
                                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6">
                                                                        <a class="mr-1 mb-1 px-4 py-3 text-sm leading-4  rounded hover:bg-white focus:border-indigo-500 focus:text-blue-500"
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
                                                                    :layouts = "this.layouts"
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
        let nodes = {};
        let edges = {};
        let layoutNodes = {};
        let person = this.person;

        nodes[`person${person.id}`] = { name: 'Person :'+person.id };
        this.incidents.forEach((incident) => {
            nodes[`incident${incident.id}`] = { name: 'Case: '+incident.id };
            edges[`incident${incident.id}`] = { source: `incident${incident.id}` , target: `person${person.id}` }
        });
        let radius = 250;
        let nodeCount = Object.keys(nodes).length;
        const nodeArray = Array.from({ length: nodeCount }, (_, i) => {
            const angle = (2 * Math.PI * i) / nodeCount;
            return {
                x: radius * Math.cos(angle),
                y: radius * Math.sin(angle),
            };
        });
        nodeArray[0].x = 0;
        nodeArray[0].y = 0;

        this.incidents.map((incident, index) => {
            layoutNodes[`incident${incident.id}`] = { x: nodeArray[index+1].x, y: nodeArray[index+1].y };
        });

        layoutNodes[`person${person.id}`] = { x: nodeArray[0].x, y: nodeArray[0].y };

        this.incidents.people.forEach((person) => {
            nodes[`person${person.id}`] = { name: 'Person: '+person.id };
            edges[`person${person.id}`] = { source: `incident${person.incident.id}` , target: `person${person.id}` }
            layoutNodes[`person${person.id}`] = { x: layoutNodes[`incident${person.incident.id}`].x*1.5, y: layoutNodes[`incident${person.incident.id}`].y*1.5 };
        });

        let layouts = {
            nodes : layoutNodes
        }
        return {
            edges,nodes,person,layouts
        }

    },
    mounted(){
    }

}
</script>

<style scoped>

</style>
