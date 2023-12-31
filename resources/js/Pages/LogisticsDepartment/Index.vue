<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import ShowLogistics from '../../Components/Department/LogisticsDepartment/ShowLogistics.vue';
import DriversInfo from './DriversInfo.vue';
import ShowOrders from '../../Components/Department/LogisticsDepartment/ShowOrders.vue';

defineProps({
    drivers:{
        type:Array
    },
    logistics:{
        type:Array
    },
    orders:{
        type:Array
    }
});

const toggle = ref('default');

</script>


<template>
    <Head title="LogisticsDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-4 items-center">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                    :class="{'underline':toggle === 'default'}"
                    @click="toggle = 'default'"
                >
                    LogisticsDepartment
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                    :class="{'underline':toggle === 'drivers'}"
                    @click="toggle = 'drivers'"
                >
                    Drivers Info
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                    :class="{'underline':toggle === 'orders'}"
                    @click="toggle = 'orders'"
                >
                    Orders Info
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div v-if="toggle === 'default'">
                        <ShowLogistics :logistics="logistics"/>
                    </div>
                    <div v-if="toggle === 'drivers'">
                        <DriversInfo :drivers="drivers"/>
                    </div>
                    <div v-if="toggle === 'orders'">
                        <ShowOrders :orders="orders"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

