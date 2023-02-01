<template>
    <GMapMap
        :center="center"
        :zoom="zoom"
        map-type-id="terrain"
        :style="'width: '+width+'; height: '+height"
    >
        <GMapMarker :key="index" v-for="(m, index) in markers" :position="m.position" :clickable="true" :draggable="false"
                    @click="openMarker(index)" >
            <GMapInfoWindow
                :closeclick="true"
                @closeclick="openMarker(null)"
                :opened="openedMarkerID === index"
            >
                <div>
                    <a :href="m.href">{{m.text}}</a>
                </div>
            </GMapInfoWindow>
        </GMapMarker>
    </GMapMap>
</template>

<script>
export default {
    props : ['center','markers','zoom','width','height'],
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
