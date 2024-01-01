<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import Show from '../../Components/Department/WarehouseDepartment/Show.vue';
import Products from '@/Components/Department/FactoryDepartment/Products.vue';

defineProps({
    warehouses:{
        type:Array
    },
    products:{
        type:Array
    }
});

const toggle = ref(true);

</script>


<template>
    <Head title="WarehouseDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                    :class="{'underline':toggle === true}"
                    @click="toggle = true"
                >
                    WarehouseDepartment
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                    :class="{'underline':toggle === false}"
                    @click="toggle = false"
                >
                    Store Products
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div v-if="toggle">
                        <Show :warehouses="warehouses"/>
                    </div>
                    <div v-else>
                        <Products :products="products"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

