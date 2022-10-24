
<template>
    <div>
        <v-tailwind-modal v-if="show" @confirm="confirm" @cancel="cancel">
            <template v-slot:title>Hello, vue-final-modal</template>
            <p>Vue Final Modal is a renderless, stackable, detachable and lightweight modal component.</p>
        </v-tailwind-modal>
        <v-button @click="show = true">Update Profile Picture</v-button>
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
