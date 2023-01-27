<template>
    <GMapMap
        :center="center"
        :zoom="10"
        map-type-id="terrain"
        style="width: 25vw; height: 20rem"
    >
        <GMapMarker :key="index" v-for="(m, index) in markers" :position="m.position" :clickable="true" :draggable="true"
                    @click="openMarker(m.id)" >
            <GMapInfoWindow
                :closeclick="true"
                @closeclick="openMarker(null)"
                :opened="openedMarkerID === m.id"
            >
                <div>I am in info window {{ m.id }} </div>
            </GMapInfoWindow>
        </GMapMarker>
    </GMapMap>
</template>

<script>
export default {
    props : ['center','markers'],
    setup(props){

    },
    data(){
        return {
            openedMarkerID: null,
        }
    },
    methods: {
        openMarker(id) {
            this.openedMarkerID = id
        }
    }
};
</script>

<style>
body {
    margin: 0;
}
</style>
