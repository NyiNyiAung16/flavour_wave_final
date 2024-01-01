<script setup>
import { router } from '@inertiajs/vue3';
import { showEdit, confrim, errors } from '../../../composable/editProductDetail'

const props = defineProps({
    factories:{
        type:Array
    }
});

const deleteFactory = ( id ) => {
    router.delete(route('factory.destroy',id));
}

const edit = (e,factory,index) => {
    showEdit(e,factory,index);
}

const confrimData = (index,factory) => {
    confrim(index,factory);
}


</script>


<template>
    <table class="w-full">
        <thead>
            <tr class="text-left border-b head">
                <th class="py-3 pe-2">No.</th>
                <th class="py-3 text-center">Product ID</th>
                <th class="py-3 text-center">Expected</th>
                <th class="py-3 text-center">Actual</th>
                <th class="py-3 text-center">Store To Warehouse</th>
                <th class="py-3 text-center">Created_at</th>
                <th class="py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b item" v-for="(factory,index) in factories" :key="factory.id">
                <td class="py-4">{{index}}</td>
                <td class="py-4 text-center">
                    <span class="block text-center" :id="`productID${index}`">{{ factory.product_id }}</span>
                    <p class="text-sm hidden text-red-500 my-1" :id="`errorid${index}`" v-show="errors.product_id">{{ errors.product_id }}</p>
                </td>
                <td class="py-4 text-center">
                    <span class="block text-center" :id="`expected${index}`">{{factory.expected}}</span>
                    <p class="text-sm hidden text-red-500 my-1" :id="`errorexpected${index}`" v-show="errors.expected">{{ errors.expected }}</p>
                </td>
                <td class="py-4 text-center">
                    <span class="block text-center" :id="`actual${index}`">{{factory.actual}}</span>
                    <p class="text-sm hidden text-red-500 my-1" :id="`erroractual${index}`" v-show="errors.actual">{{ errors.actual }}</p>
                </td>
                <td class="py-4 text-center">{{factory.isStore}}</td>
                <td class="py-4 text-center">{{new Date(factory.created_at).toLocaleDateString()}}</td>
                <td class="py-4 space-x-3 text-center">
                    <button class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="edit($event,factory,index)" :id="`editBtn${index}`">Edit</button>
                    <button class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="confrimData(index,factory)" :id="`confirmBtn${index}`">Confrim</button>
                    <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteFactory(factory.id)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

