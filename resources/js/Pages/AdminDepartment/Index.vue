<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateUser from '../../Components/Department/AdminDepartment/CreateUser.vue'
import ShowUser from '../../Components/Department/AdminDepartment/ShowUser.vue';
import Charts from '@/Components/Department/AdminDepartment/Charts.vue'
import CreateReport from '@/Components/Department/AdminDepartment/CreateReport.vue';
import ShowReports from '@/Components/Department/AdminDepartment/ShowReports.vue';


defineProps({
    user:{
        type:Object
    },
    users:{
        type:Array
    }
});

const toggle = ref('allUser');

</script>


<template>
    <Head title="AdminDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer"
                :class="{'underline':toggle === 'allUser'}"
                @click="toggle = 'allUser'"
                >
                    All Users
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer"
                :class="{'underline':toggle === 'report'}"
                @click="toggle = 'report'"
                >
                    Reports
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer"
                :class="{'underline':toggle === 'createUser'}"
                @click="toggle = 'createUser'"
                >
                    Create User
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer"
                :class="{'underline':toggle === 'createReport'}"
                @click="toggle = 'createReport'"
                >
                    Create Report
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div v-if="toggle === 'allUser'">
                        <ShowUser :users="users"/>
                    </div>
                    <div v-if="toggle === 'report'">
                        <ShowReports/>
                    </div>
                    <div v-if="toggle === 'createUser'">
                        <CreateUser/>
                    </div>
                    <div v-if="toggle === 'createReport'">
                        <CreateReport/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

