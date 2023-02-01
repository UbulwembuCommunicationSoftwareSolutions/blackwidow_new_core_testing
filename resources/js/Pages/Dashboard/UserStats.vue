<template>
    <div class="mt-12 flex flex-row flex-grow">
        <div class="flex w-1/2">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">My Cases : Status</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Pending cases assigned to me</dt>
                        <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{incident_stats.pending}}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Referred cases assigned to me</dt>
                        <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{incident_stats.referred}}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Closed cases assigned to me</dt>
                        <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{incident_stats.closed}}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="flex w-1/2">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">My Cases : Departments</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div v-for="department in departments" class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500"> {{ department.description }} </dt>
                        <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{department.incidents_count}}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
import {PaperClipIcon} from "@heroicons/vue/20/solid";

export default {
    name: "UserStats",
    props : ['incident_stats','departments'],
    components: {
        PaperClipIcon
    },
}
</script>

<style scoped>

</style>
