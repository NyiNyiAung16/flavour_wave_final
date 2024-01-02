<script setup>
import { router } from '@inertiajs/vue3';
import { showEdit, confrim, errors  } from '../../composable/editDriver'

defineProps({
    drivers:{
        type:Array
    }
});

const edit = (e,driver,index)=>{
    showEdit(e,driver,index);
}

const confrimData = (index,driver) =>{
    confrim(index,driver);
}

const deleteDriver = (id) => {
    router.delete(route('driver.destroy',id));
}

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3 text-center">Name</th>
                    <th class="py-3 text-center">Vehicle Number</th>
                    <th class="py-3 text-center">IsFree</th>
                    <th class="py-3 text-center">Created_at</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(driver,index) in drivers" :key="driver.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 text-center">
                        <span :id="`name${index}`" class="block text-center">{{ driver.name }}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorname${index}`" v-show="errors.name">{{ errors.name }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`vehicle_number${index}`" class="block text-center">{{driver.vehicle_number}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errornumber${index}`" v-show="errors.vehicle_number">{{ errors.vehicle_number }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`isFree${index}`" class="block text-center">{{driver.isFree ? 'Free' : 'Busy'}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorisFree${index}`" v-show="errors.isFree">{{ errors.isFree }}</p>
                    </td>
                    <td class="py-4 text-center">{{new Date(driver.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <button class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="edit($event,driver,index)" :id="`editBtn${index}`">Edit</button>
                        <button class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="confrimData(index,driver)" :id="`confirmBtn${index}`">Confrim</button>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteDriver(driver.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

