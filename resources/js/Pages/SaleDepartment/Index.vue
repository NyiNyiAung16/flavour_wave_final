<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Preorders from '../../Components/customer/Preorders.vue';
import Urgent from '../../components/customer/Urgent.vue';
import ShowOrders from '../../Components/Department/LogisticsDepartment/ShowOrders.vue'

defineProps({
    preorders:{
        type:Array
    },
    urgents:{
        type:Array
    },
    user:{
        type:Object
    },
    orders:{
        type:Array
    }
});

const toggle = ref('default');

</script>


<template>
    <Head title="SaleDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                :class="{'underline':toggle === 'default'}"
                @click="toggle = 'default'"
                >
                    SaleDepartment
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                :class="{'underline':toggle === 'urgents'}"
                @click="toggle = 'urgents'"
                >
                    Urgent Orders
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                :class="{'underline':toggle === 'orders'}"
                @click="toggle = 'orders'"
                >
                    Confrimed Orders
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div v-if="toggle === 'default'">
                        <Preorders :preorders="preorders" :user="user"/>
                    </div>
                    <div v-if="toggle === 'urgents'">
                        <Urgent :urgents="urgents" :user="user"/>
                    </div>
                    <div v-if="toggle === 'orders'">
                        <ShowOrders :orders="orders"/>
                    </div>  
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

