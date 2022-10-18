<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from "@inertiajs/inertia-vue3";
import Treeselect from 'vue3-treeselect'
// import the styles
import 'vue3-treeselect/dist/vue3-treeselect.css'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Treeselect
    },
    props:{
        user :  Object,
        available_institutions : Array,
        user_institutions : Array
    },
    setup(props){
        const form = useForm({
            selected_institutions : props.user_institutions,
            available_institutions : props.available_institutions,
            first_name: props.user.first_name,
            surname: props.user.surname,
            maiden_name: props.user.maiden_name,
            nickname: props.user.nickname,
            gender: props.user.gender,
            race: props.user.race,
            marital_status: props.user.marital_status,
            weight: props.user.weight,
            length: props.user.length,
            birth_place: props.user.birth_place,
            age: props.user.age,
            nationality: props.user.nationality,
            language_spoken: props.user.language_spoken,
            religion: props.user.religion,
        });
        return {
            form
        }
    },
    data(){
        return {
            selected: null,
        }
    },
    mounted(){
        console.log(form.user_institutions)
    },
    methods:{
        adminPanel(){
            window.location.href = '/admin';
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:py-6 lg:py-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



        <div class="mt-10 ml-8 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg  mt-10 font-medium leading-6 text-gray-900">Personal Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form action="#" method="POST">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                                        <input v-model="form.first_name" type="text" name="first_name" id="first_name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                                        <input v-model="form.surname" type="text" name="surname" id="surname" autocomplete="surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="maiden_name" class="block text-sm font-medium text-gray-700">Maiden Name</label>
                                        <input v-model="form.maiden_name" type="text" name="maiden_name" id="maiden_name" autocomplete="maiden-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname</label>
                                        <input v-model="form.nickname" type="text" name="nickname" id="nickname" autocomplete="nickname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6">
                                        <treeselect v-model="form.selected_institutions" :multiple="true" :options="form.available_institutions" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                        <select v-model="form.gender" id="gender" name="gender" autocomplete="gender" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option>Female </option>
                                            <option>Male</option>
                                            <option>Trans Female</option>
                                            <option>Trans Male</option>
                                            <option>Nonconforming</option>
                                            <option>Lesbian</option>
                                            <option>Gay</option>
                                            <option>Bisexual</option>
                                            <option>Queer Individual</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="race" class="block text-sm font-medium text-gray-700">Race</label>
                                        <select v-model="form.race" id="race" name="gender" autocomplete="race" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option>Black</option>
                                            <option>Coloured</option>
                                            <option>Indian</option>
                                            <option>White</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital Status</label>
                                        <select v-model="form.marital_status" id="marital_status" name="gender" autocomplete="marital_status" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option>Married</option>
                                            <option>Cohabiting(Living Together)</option>
                                            <option>Widow/Widower</option>
                                            <option>Separated</option>
                                            <option>Divorced</option>
                                            <option>Never Married/Single</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="weight" class="block text-sm font-medium text-gray-700">Weight(kg)</label>
                                        <input v-model="form.weight" type="number" name="weight" id="weight" autocomplete="weight" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="length" class="block text-sm font-medium text-gray-700">Length(cm)</label>
                                        <input v-model="form.length" type="number" name="length" id="length" autocomplete="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="birth_place" class="block text-sm font-medium text-gray-700">Birth Place</label>
                                        <input  v-model="form.birth_place" type="text" name="birth_place" id="birth_place" autocomplete="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                        <input v-model="form.date_of_birth" type="date" name="birth_place" id="date_of_birth" autocomplete="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                        <input v-model="form.age" type="number" name="age" id="age" autocomplete="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                                        <input v-model="form.nationality" type="text" name="nationality" id="nationality" autocomplete="maiden-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="language_spoken" class="block text-sm font-medium text-gray-700">Language Spoken</label>
                                        <select  v-model="form.language_spoken" id="language_spoken" name="nationality" autocomplete="language_spoken" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option>Afrikaans</option>
                                            <option>English</option>
                                            <option>isiNdebele</option>
                                            <option>isiXhosa</option>
                                            <option>isiZulu</option>
                                            <option>Sesotho</option>
                                            <option>Sesotho sa Leboa (Sepedi)</option>
                                            <option>Setswana</option>
                                            <option>siSwati</option>
                                            <option>Tshivenda</option>
                                            <option>Xitsonga</option>
                                            <option>Other</option>
                                            <option>Foreign</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
                                        <select v-model="form.religion" id="religion" name="religion" autocomplete="religion" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option>Atheist /Agnostic</option>
                                            <option>Catholic</option>
                                            <option>Christianity</option>
                                            <option>Islam</option>
                                            <option>Hinduism</option>
                                            <option>Traditional</option>
                                            <option>Judaism</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form action="#" method="POST">
                                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700"> Photo</label>
                                                <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                                    <div class="space-y-1 text-center">
                                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <div class="flex text-sm text-gray-600">
                                                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                                                <span>Upload a file</span>
                                                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                                            </label>
                                                            <p class="pl-1">or drag and drop</p>
                                                        </div>
                                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 ml-8 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
                        <p class="mt-1 text-sm text-gray-600">Decide which communications you'd like to receive and how.</p>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form action="#" method="POST">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                <fieldset>
                                    <legend class="sr-only">By Email</legend>
                                    <div class="text-base font-medium text-gray-900" aria-hidden="true">By Email</div>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex h-5 items-center">
                                                <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="comments" class="font-medium text-gray-700">Comments</label>
                                                <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="flex h-5 items-center">
                                                <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                                                <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="flex h-5 items-center">
                                                <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="offers" class="font-medium text-gray-700">Offers</label>
                                                <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend class="contents text-base font-medium text-gray-900">Push Notifications</legend>
                                    <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-center">
                                            <input id="push-everything" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">Everything</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="push-email" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="push-email" class="ml-3 block text-sm font-medium text-gray-700">Same as email</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="push-nothing" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">No push notifications</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
