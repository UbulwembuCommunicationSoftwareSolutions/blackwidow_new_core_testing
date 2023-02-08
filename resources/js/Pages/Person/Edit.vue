<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from "@inertiajs/inertia-vue3";
import Treeselect from 'vue3-treeselect'
// import the styles
import 'vue3-treeselect/dist/vue3-treeselect.css'
import ProfilePictureModal  from "@/Components/ProfilePictureModal.vue";
import Page1 from  "@/Pages/Person/Page1.vue";
import Page2 from  "@/Pages/Person/Page1.vue";
export default {
    components: {
        AuthenticatedLayout,
        Head,
        Treeselect,
        ProfilePictureModal,
        Page1,
        Page2,
    },
    props:{
        person :  Object,
        available_institutions : Array,
        person_institutions : Array,
        permissions : Array,
    },
    setup(props){
        const form = useForm({
            person : props.person,
            selected_institutions : props.person_institutions,
            available_institutions : props.available_institutions,
        });
        let permissions = props.permissions;
        return {
            form,permissions
        }
    },
    data(){
        return {
            current_page : 1,
            isModalVisible: false,
            selected: null,
        }
    },
    mounted(){
    },
    methods:{
        adminPanel(){
            window.location.href = '/admin';
        },
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<template>
    <Head title="Person of Interest" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Person of Interest
            </h2>
        </template>
        <div
            v-if="$page.props.flash.success"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
                    <span class="font-medium">
                        {{ $page.props.flash.success }}
                    </span>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:py-6 lg:py-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div v-if="this.displayPage===1" id="page_1">
                    <Page1
                        :person="this.person"
                        :available_institutions="this.available_institutions"
                        :person_institutions="this.person_institutions"
                        :permissions="this.permissions"
                    />
                </div>
                <div v-if="this.displayPage===2" id="page_2">
                    <Page2 :person="this.person"/>
                </div>
            </div>




        </div>
        </div>


    </AuthenticatedLayout>
</template>
