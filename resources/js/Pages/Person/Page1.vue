<template>
    <div class="mt-10 ml-8 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg  mt-10 font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-600">Basic Information</p>
                    <img :src="'/person_files/'+person.profile_picture">
                    <button @click="this.showModal()" type="button" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <!-- Heroicon name: mini/envelope -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
                        Update Profile Picture
                    </button>
                    <div v-if="permissions.includes('person_edit')">
                        <ProfilePictureModal
                            v-if="this.isModalVisible"
                            :object="this.form.person.id"
                            url="/profile_picture/person"
                            @close="this.closeModal()"
                        />
                    </div>
                    <div v-for="incident in person.incidents">
                        <div>Incident {{incident.id}}</div>
                    </div>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form @submit.prevent="submitPersonForm()">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                                    <input v-model="form.person.first_name" type="text" name="first_name" id="first_name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                                    <input v-model="form.person.surname" type="text" name="surname" id="surname" autocomplete="surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="maiden_name" class="block text-sm font-medium text-gray-700">Maiden Name</label>
                                    <input v-model="form.person.maiden_name" type="text" name="maiden_name" id="maiden_name" autocomplete="maiden-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname</label>
                                    <input v-model="form.person.nickname" type="text" name="nickname" id="nickname" autocomplete="nickname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="multi" class="block text-sm font-medium text-gray-700">Institution</label>
                                </div>
                                <div class="col-span-6">
                                    <treeselect id="multi" v-model="form.selected_institutions" :multiple="true" :options="form.available_institutions" />
                                    <treeselect-value :value="form.selected_institutions" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                    <select v-model="form.person.gender" id="gender" name="gender" autocomplete="gender" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
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
                                    <select v-model="form.person.race" id="race" name="gender" autocomplete="race" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option>Black</option>
                                        <option>Coloured</option>
                                        <option>Indian</option>
                                        <option>White</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital Status</label>
                                    <select v-model="form.person.marital_status" id="marital_status" name="gender" autocomplete="marital_status" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
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
                                    <input v-model="form.person.weight" type="number" name="weight" id="weight" autocomplete="weight" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="length" class="block text-sm font-medium text-gray-700">Length(cm)</label>
                                    <input v-model="form.person.length" type="number" name="length" id="length" autocomplete="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="birth_place" class="block text-sm font-medium text-gray-700">Birth Place</label>
                                    <input  v-model="form.person.birth_place" type="text" name="birth_place" id="birth_place" autocomplete="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                    <input v-model="form.person.date_of_birth" type="date" name="birth_place" id="date_of_birth" autocomplete="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                    <input v-model="form.person.age" type="number" name="age" id="age" autocomplete="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                                    <input v-model="form.person.nationality" type="text" name="nationality" id="nationality" autocomplete="maiden-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="language_spoken" class="block text-sm font-medium text-gray-700">Language Spoken</label>
                                    <select  v-model="form.person.language_spoken" id="language_spoken" name="nationality" autocomplete="language_spoken" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
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
                                    <select v-model="form.person.religion" id="religion" name="religion" autocomplete="religion" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
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
                    </div>
                    <div v-if="permissions.includes('person_edit')" class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
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
</template>

<script>
import {PaperClipIcon} from "@heroicons/vue/20/solid";
import {useForm} from "@inertiajs/inertia-vue3";
import ProfilePictureModal from "@/Components/ProfilePictureModal.vue";
import Treeselect from 'vue3-treeselect'

import 'vue3-treeselect/dist/vue3-treeselect.css'

export default {
    name: "Page1",
    props : ['person','permissions','person_institutions','available_institutions'],
    components: {
        PaperClipIcon,ProfilePictureModal,Treeselect,

    },
    setup(props){
        const form = useForm({
            person : props.person,
            selected_institutions : props.person_institutions,
            available_institutions : props.available_institutions,
        });
        return {
            form
        }
    },
    data(){
      return {
          isModalVisible: false,
          selected: null,
      }
    },
    methods :{
        submitPersonForm(){
            this.form.put(route("person.update", this.form.person.id));
        },
        showModal() {
            console.log("Showing Modal");
            console.log(this.isModalVisible)
            this.isModalVisible = true;
            console.log(this.isModalVisible)
        },
        closeModal() {
            this.isModalVisible = false;
        }
    }
}
</script>

<style scoped>

</style>
