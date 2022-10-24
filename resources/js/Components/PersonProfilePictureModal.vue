
<template>
    <div>
        <vue-final-modal v-model="show">
            Modal Content Here
        </vue-final-modal>
        <button @click="show = true">Open Modal</button>
    </div>
</template>




<script>
import { $vfm, VueFinalModal, ModalsContainer } from 'vue-final-modal'

export default {
    components: {
        VueFinalModal,
        ModalsContainer
    },
    data: () => ({
        show: false
    }),
    methods: {
        confirm() {
            // some code...
            this.show = false
        },
        cancel() {
            this.show = false;
        }
    }
}
</script>
