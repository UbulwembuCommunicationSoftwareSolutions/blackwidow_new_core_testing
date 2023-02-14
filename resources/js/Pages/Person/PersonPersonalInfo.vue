<template>
    <div class="flex flex-row flex-grow">
            Hello
    </div>
</template>

<script>
import {PaperClipIcon} from "@heroicons/vue/20/solid";

export default {
    name: "Page2",
    props : ['person'],
    components: {
        PaperClipIcon
    },

}
</script>

<style scoped>

</style>
