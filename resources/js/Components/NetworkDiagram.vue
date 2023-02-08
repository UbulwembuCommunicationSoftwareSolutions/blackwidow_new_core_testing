<script lang="ts">
import { reactive, ref, watch } from "vue"
import * as vNG from "v-network-graph"
import { ForceLayout } from "v-network-graph/lib/force-layout"
import { ForceNodeDatum } from "v-network-graph/lib/force-layout"
import { ForceEdgeDatum } from "v-network-graph/lib/force-layout"

export default {
    props: ['nodes','edges'],
    setup(){
        const nodeCount = ref(20)
        const nodes = reactive({})
        const edges = reactive({})
        const configs = reactive(
            vNG.defineConfigs({
                view: {
                    layoutHandler: new ForceLayout({
                        positionFixedByDrag: false,
                        positionFixedByClickWithAltKey: true,
                        // * The following are the default parameters for the simulation.
                        // * You can customize it by uncommenting below.
                        createSimulation: (d3, nodes, edges) => {
                          const forceLink = d3.forceLink<ForceNodeDatum, ForceEdgeDatum>(edges).id(d => d.id)
                          return d3
                            .forceSimulation(nodes)
                            .force("edge", forceLink.distance(50))
                            .force("charge", d3.forceManyBody())
                            .force("collide", d3.forceCollide(50).strength(0.2))
                            .force("center", d3.forceCenter().strength(0.05))
                            .alphaMin(0.001)
                        }
                    }),
                },
                node: {
                    label: {
                        visible: true,
                        fontFamily: undefined,
                        fontSize: 11,
                        lineHeight: 1.1,
                        color: "#000000",
                        margin: 4,
                        direction: "south",
                        directionAutoAdjustment: true,
                        text: "name",
                    },
                }
            })
        )
        return {
            configs
        }
    }
}

</script>

<template>

    <v-network-graph
        :zoom-level="0.5"
        :nodes="nodes"
        :edges="edges"
        :configs="configs"
    />
</template>
<style>
.v-ng-canvas {
    width: 800px;
    height: 400px;
    border: 1px solid #000;
}
</style>

