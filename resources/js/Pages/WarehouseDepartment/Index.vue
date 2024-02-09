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
            <div class="flex flex-col gap-5">
                <h2 class="sideBar" 
                    :class="{'active-sideBar':toggle === 'default'}"
                    @click="toggle = 'default'"
                >
                    Products Details
                </h2>
                <h2 class="sideBar" 
                    :class="{'active-sideBar':toggle === 'storeProducts'}"
                    @click="toggle = 'storeProducts'"
                >
                    Products
                </h2>
                <h2 class="sideBar" 
                    :class="{'active-sideBar':toggle === 'create'}"
                    @click="toggle = 'create'"
                >
                    Create Warehouse
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div 
                    class="overflow-hidden sm:rounded-lg"
                >
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

