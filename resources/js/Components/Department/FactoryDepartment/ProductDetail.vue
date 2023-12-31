<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    factories:{
        type:Array
    }
});

const deleteFactory = ( id ) => {
    router.delete(route('factory.destroy',id));
}


</script>


<template>
    <table class="w-full">
        <thead>
            <tr class="text-left border-b head">
                <th class="py-3 pe-2">No.</th>
                <th class="py-3">Product Names</th>
                <th class="py-3 text-center">Expected</th>
                <th class="py-3 text-center">Actual</th>
                <th class="py-3 text-center">Store To Warehouse</th>
                <th class="py-3">Created_at</th>
                <th class="py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b item" v-for="(factory,index) in factories" :key="factory.id">
                <td class="py-4">{{index}}</td>
                <td class="py-4  flex gap-x-2">{{ factory.product_name }}</td>
                <td class="py-4 text-center">{{factory.expected}}</td>
                <td class="py-4 text-center">{{factory.actual}}</td>
                <td class="py-4 text-center">{{factory.isStore}}</td>
                <td class="py-4 text-center">{{new Date(factory.created_at).toLocaleDateString()}}</td>
                <td class="py-4 space-x-3 text-center">
                    <Link :href="`/factoryDepartment/productsDetail/${factory.id}/edit`" class=" text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                    <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteFactory(factory.id)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

