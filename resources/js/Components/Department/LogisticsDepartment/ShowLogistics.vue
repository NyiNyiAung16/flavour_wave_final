<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    logistics:{
        type:Array
    }
});

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3">Preorder ID</th>
                    <th class="py-3 text-center">Driver Name</th>
                    <th class="py-3 text-center">Driver Vehicle Number</th>
                    <th class="py-3 text-center">Quantity</th>
                    <th class="py-3 text-center">Deliver Date</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(logistic,index) in logistics" :key="logistic.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">{{ logistic.preorder_id }}</td>
                    <td class="py-4 text-center">{{logistic.driver_name}}</td>
                    <td class="py-4 text-center">{{logistic.driver_vehicle_number}}</td>
                    <td class="py-4 text-center">{{logistic.quantity}}</td>
                    <td class="py-4 text-center">{{new Date(logistic.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`/factoryDepartment/ingredients/${logistic.id}/edit`" class=" text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteLogistic(logistic.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

