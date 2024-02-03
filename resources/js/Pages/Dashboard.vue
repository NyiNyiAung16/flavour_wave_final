<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Preorders from '../Components/customer/Preorders.vue'
import Urgent from '../Components/customer/Urgent.vue'
import CancelOrders from '../Components/customer/CancelOrders.vue'

const props = defineProps({
    preorders:{
        type:Array
    },
    urgents:{
        type:Array
    },
    cancelOrders:{
        type:Array
    },
    user:{
        type:Object
    }
});

const toggle = ref('preorders');

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-5" v-if="!user.isAdmin">
                <h2 class="sideBar" 
                :class="{'active-sideBar':toggle === 'preorders'}"
                @click="toggle = 'preorders'"
                >
                    Preorders
                </h2>
                <h2 class="sideBar"
                :class="{'active-sideBar':toggle === 'urgent'}"
                @click="toggle = 'urgent'"
                >
                    Urgents Orders
                </h2>
                <h2 class="sideBar"
                :class="{'active-sideBar':toggle === 'cancel'}"
                @click="toggle = 'cancel'"
                >
                    Cancel Orders
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden overflow-x-scroll shadow-sm sm:rounded-lg p-3">
                    <div v-if="!user.isAdmin">
                        <div v-if="toggle === 'preorders'">
                            <Preorders :preorders="preorders" :user="user"/>
                        </div>
                        <div v-if="toggle === 'urgent'">
                            <Urgent :urgents="urgents" :user="user"/>
                        </div>
                        <div v-if="toggle === 'cancel'">
                            <CancelOrders :cancel-orders="cancelOrders"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
