<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Preorders from '../Components/customer/Preorders.vue'
import Urgent from '../Components/customer/Urgent.vue'

const props = defineProps({
    preorders:{
        type:Array
    },
    urgents:{
        type:Array
    },
    user:{
        type:Object
    }
});


const toggle = ref(true);

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5" v-if="!user.isAdmin">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                :class="{'underline':toggle === true}"
                @click="toggle = true"
                >
                    Preorders
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer"
                :class="{'underline':toggle === false}"
                @click="toggle = false"
                >
                    Urgents Orders
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div v-if="!user.isAdmin">
                        <div v-if="toggle">
                            <Preorders :preorders="preorders"/>
                        </div>
                        <div v-else>
                            <Urgent :urgents="urgents"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
