<template>
    <div>
        <VTailwindmodal v-model="show" @confirm="confirm" @cancel="cancel">
            <template v-slot:title>Hello, vue-final-modal</template>
            <p>Vue Final Modal is a renderless, stackable, detachable and lightweight modal component.</p>
        </VTailwindmodal>
        <v-button @click="show = true">Open modal</v-button>
    </div>
</template>


<script>
import VTailwindmodal from "@/Components/VTailwindModal.vue";
export default {
    components: {
        VTailwindmodal
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
