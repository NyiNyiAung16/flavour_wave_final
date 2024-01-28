<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Preorders from '../../Components/customer/Preorders.vue';
import Urgent from '../../components/customer/Urgent.vue';
import ShowOrders from '../../Components/Department/LogisticsDepartment/ShowOrders.vue'
import ShowUrgentOrders from '@/Components/Department/LogisticsDepartment/ShowUrgentOrders.vue'

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
    confrim_preorders:{
        type:Array
    },
    urgent_orders:{
        type:Array
    }
});

const toggle = ref('default');

</script>


<template>
    <Head title="SaleDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-5">
                <h2 class="sideBar" 
                :class="{'active-sideBar':toggle === 'default'}"
                @click="toggle = 'default'"
                >
                    Preorders
                </h2>
                <h2 class="sideBar" 
                :class="{'active-sideBar':toggle === 'urgents'}"
                @click="toggle = 'urgents'"
                >
                    Urgent Orders
                </h2>
                <h2 class="sideBar" 
                :class="{'active-sideBar':toggle === 'orders'}"
                @click="toggle = 'orders'"
                >
                    Confrimed & Cancel Preorders
                </h2>
                <h2 class="sideBar" 
                :class="{'active-sideBar':toggle === 'urgentOrders'}"
                @click="toggle = 'urgentOrders'"
                >
                    Confrimed & Cancel Urgent Orders
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden overflow-x-scroll shadow-sm sm:rounded-lg p-3">
                    <div v-if="toggle === 'default'">
                        <Preorders :preorders="preorders" :user="user"/>
                    </div>
                    <div v-if="toggle === 'urgents'">
                        <Urgent :urgents="urgents" :user="user"/>
                    </div>
                    <div v-if="toggle === 'orders'">
                        <ShowOrders :preorders="confrim_preorders"/>
                    </div>  
                    <div v-if="toggle === 'urgentOrders'">
                        <ShowUrgentOrders :urgents="urgent_orders"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

