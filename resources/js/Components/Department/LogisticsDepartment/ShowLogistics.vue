<script setup>
import { router } from '@inertiajs/vue3'
import { showEdit, confrim, errors } from '../../../composable/editDeliver'

defineProps({
    logistics:{
        type:Array
    }
});

const deleteLogistic = (id) => {
    router.delete(route('logistic.destroy',id));
}

const edit = (e,logistic,index) => {
    showEdit(e,logistic,index);
}

const confrimData = (index,logistic) => {
    confrim(index,logistic);
}

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3 text-center">Preorder ID</th>
                    <th class="py-3 text-center">Driver ID</th>
                    <th class="py-3 text-center">Quantity</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="py-3 text-center">Deliver Date</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(logistic,index) in logistics" :key="logistic.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 text-center">
                        <span :id="`preorderID${index}`" class="block text-center">{{ logistic.preorder_id }}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorp${index}`" v-show="errors.preorder_id">{{ errors.preorder_id }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`driverID${index}`" class="block text-center">{{logistic.driver_id}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errord${index}`" v-show="errors.driver_id">{{ errors.driver_id }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`quantity${index}`" class="block text-center">{{logistic.quantity}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorq${index}`" v-show="errors.quantity">{{ errors.quantity }}</p>
                    </td>
                    <td class="py-4 text-center">{{logistic.status}}</td>
                    <td class="py-4 text-center">{{new Date(logistic.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <button class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="edit($event,logistic,index)" :id="`editBtn${index}`">Edit</button>
                        <button class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="confrimData(index,logistic)" :id="`confirmBtn${index}`">Confrim</button>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteLogistic(logistic.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

