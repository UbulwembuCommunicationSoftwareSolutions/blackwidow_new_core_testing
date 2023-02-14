<template>
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
import NetworkDiagram from "@/Components/NetworkDiagram.vue";
import Loading from "@/Components/Loading.vue";

export default {
    name: "Page2",
    components:{
      NetworkDiagram,Loading
    },
    props : ['interest_group'],
    setup(props){
      let interest_group = props.interest_group;
      return {
          interest_group
      }
    },
    data(){
        let temp_nodes = {};
        let edges = {};

        temp_nodes[`group${this.interest_group.id}`] = { name: 'Group: ' + this.interest_group.description };

        this.interest_group.people.map((person, index) => {
            temp_nodes[`person${person.id}`] = { name: 'Person: ' + person.id + ' '+person.first_name+ '' + person.surname };
            edges[`group${this.interest_group.id}`] = { source: `person${person.id}` , target: `group${this.interest_group.id}` }
        });

        let nodes = temp_nodes;

        return {
            edges,nodes
        }
    }
}
</script>

<style scoped>

</style>
