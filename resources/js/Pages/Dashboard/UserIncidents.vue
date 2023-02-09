<template>
    <div class="flex flex-row flex-grow">
        <div class="flex mt-4 py-6 w-full h-96 whitespace-nowrap px-6">
            <div class="w-full bg-white shadow sm:rounded-lg">
                <GoogleMap :height="'400px'" :width="'100%'" :zoom="8" :center="this.center" :markers="this.markers"></GoogleMap>
            </div>
        </div>
    </div>
</template>

<script>
import GoogleMap from "@/Components/GoogleMap.vue";
import {PaperClipIcon} from "@heroicons/vue/20/solid";
export default {
    name: "UserIncidents",
    props : ['markers'],
    components: {
        GoogleMap,
        PaperClipIcon
    },
    setup(props){
        return {
            markers: props.markers
        }
    },
    data(){
        return{
            latitude : null,
            longitude : null,
            center : null,
        }
    },
    methods :{
        getLocation() {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    this.latitude = position.coords.latitude;
                    this.longitude = position.coords.longitude;
                    this.center = { lat: parseFloat( this.latitude ), lng: parseFloat(this.longitude) },

                },
                (error) => {
                    console.error(error);
                }
            );
        }
    },
    mounted(){
        this.getLocation();
    }
}
</script>

<style scoped>

</style>
