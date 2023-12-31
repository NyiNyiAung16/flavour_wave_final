<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import Show from '../../Components/Department/WarehouseDepartment/Show.vue';

defineProps({
    warehouses:{
        type:Array
    }
});

const toggle = ref(true);

</script>


<template>
    <Head title="WarehouseDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                :class="{'underline':toggle === true}"
                @click="toggle = true"
            >
                WarehouseDepartment
            </h2>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <Show :warehouses="warehouses"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

