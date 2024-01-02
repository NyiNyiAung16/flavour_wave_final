<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import Show from '../../Components/Department/WarehouseDepartment/Show.vue';
import Products from '@/Components/Department/FactoryDepartment/Products.vue';
import Create from '@/Components/Department/WarehouseDepartment/Create.vue';

defineProps({
    warehouses:{
        type:Array
    },
    products:{
        type:Array
    }
});

const toggle = ref('default');

</script>


<template>
    <Head title="WarehouseDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer" 
                    :class="{'underline':toggle === 'default'}"
                    @click="toggle = 'default'"
                >
                    WarehouseDepartment
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer" 
                    :class="{'underline':toggle === 'storeProducts'}"
                    @click="toggle = 'storeProducts'"
                >
                    Store Products
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer" 
                    :class="{'underline':toggle === 'create'}"
                    @click="toggle = 'create'"
                >
                    Create 
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div v-if="toggle === 'default'">
                        <Show :warehouses="warehouses"/>
                    </div>
                    <div v-if="toggle === 'storeProducts'">
                        <Products :products="products"/>
                    </div>
                    <div v-if="toggle === 'create'">
                        <Create/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

