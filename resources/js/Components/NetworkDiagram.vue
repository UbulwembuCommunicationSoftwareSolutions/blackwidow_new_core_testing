

<script>
export default {
    name: "NetworkDiagram",
    props: ['nodes','edges','layouts']
}

</script>

<template>
    <v-network-graph
        class="graph"
        :nodes="nodes"
        :edges="edges"
        :layouts="layouts"
    />
</template>

<style>
.graph {
    width: 800px;
    height: 400px;
    border: 1px solid #000;
}
</style>
