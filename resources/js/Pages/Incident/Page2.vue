<template>
    <div class="flex flex-row flex-grow">
        <div class="flex mt-4 py-6 w-full whitespace-nowrap px-6">
            <div class="overflow-hidden w-full bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Case Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div v-for="(person,index) in this.incident.people" :key="index" class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ person.id }}</dt>
                            <dt class="text-sm font-medium text-gray-500">{{ person.first_name }}</dt>
                            <dt class="text-sm font-medium text-gray-500">{{ person.surname }}</dt>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {PaperClipIcon} from "@heroicons/vue/20/solid";

export default {
    name: "Page2",
    props : ['incident'],
    components: {
        PaperClipIcon
    },

}
</script>

<style scoped>

</style>
