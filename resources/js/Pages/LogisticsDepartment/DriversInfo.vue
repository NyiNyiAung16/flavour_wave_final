<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    drivers:{
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
                    <th class="py-3">Name</th>
                    <th class="py-3 text-center">Vehicle Number</th>
                    <th class="py-3 text-center">IsFree</th>
                    <th class="py-3 text-center">Created_at</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(driver,index) in drivers" :key="driver.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">{{ driver.name }}</td>
                    <td class="py-4 text-center">{{driver.vehicle_number}}</td>
                    <td class="py-4 text-center">{{driver.isFree ? 'Free' : 'Busy'}}</td>
                    <td class="py-4 text-center">{{new Date(driver.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`/factoryDepartment/ingredients/${driver.id}/edit`" class=" text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteDriver(driver.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

