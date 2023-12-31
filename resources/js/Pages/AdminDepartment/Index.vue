<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateUser from '../../Components/Department/AdminDepartment/CreateUser.vue'
import ShowUser from '../../Components/Department/AdminDepartment/ShowUser.vue';


defineProps({
    user:{
        type:Object
    },
    users:{
        type:Array
    }
});

const toggle = ref('dashboard');

</script>


<template>
    <Head title="AdminDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                :class="{'underline':toggle === 'dashboard'}"
                @click="toggle = true"
                >
                    AdminDepartment
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer"
                :class="{'underline':toggle === 'allUser'}"
                @click="toggle = 'allUser'"
                >
                    All User
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer"
                :class="{'underline':toggle === 'createUser'}"
                @click="toggle = 'createUser'"
                >
                    Create User
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div v-if="toggle === 'createUser'">
                        <CreateUser/>
                    </div>
                    <div v-if="toggle === 'allUser'">
                        <ShowUser :users="users"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

