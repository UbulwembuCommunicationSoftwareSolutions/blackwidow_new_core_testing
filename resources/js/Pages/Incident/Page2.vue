<template>
    <div v-if="this.page===1" class="flex flex-row flex-grow">
        <div class="flex mt-4 py-6 w-full whitespace-nowrap px-6">
            <div class="overflow-hidden w-full bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Case Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Case ID</dt>
                            <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{incident.id}}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Case Description</dt>
                            <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{incident.description}}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Department</dt>
                            <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{incident.department.description}}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Category</dt>
                            <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{incident.department.description}}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Sub Category</dt>
                            <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{incident.department.description}}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Sub Sub Category</dt>
                            <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{incident.department.description}}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                            <dd class="mt-1 text-right text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                            <span class="ml-2 w-0 flex-1 truncate">resume_back_end_developer.pdf</span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                        </div>
                                    </li>
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                            <span class="ml-2 w-0 flex-1 truncate">coverletter_back_end_developer.pdf</span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Page2"
}
</script>

<style scoped>

</style>
