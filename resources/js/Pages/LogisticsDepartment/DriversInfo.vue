<script setup>
import Button from '@/Components/Button.vue'
import Body from '@/Components/Table/Body.vue';
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
                    <Body
                        :text-id="`name${index}`"
                        :error-id="`errorname${index}`"
                        :value="driver.name"
                        :error="errors.name"
                    />
                    <Body
                        :text-id="`vehicle_number${index}`"
                        :error-id="`errornumber${index}`"
                        :value="driver.vehicle_number"
                        :error="errors.vehicle_number"
                    />
                    <Body
                        :text-id="`isFree${index}`"
                        :error-id="`errorisFree${index}`"
                        :value="driver.isFree ? 'Free' : 'Busy'"
                        :error="errors.isFree"
                    />
                    <td class="py-4 text-center">{{new Date(driver.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Button
                            type="button"
                            text="Edit"
                            class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" 
                            :id="`editBtn${index}`"
                            @click="edit($event,driver,index)" 
                        />
                        <Button
                            type="button"
                            text="Confrim"
                            class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" 
                            :id="`confirmBtn${index}`"
                            @click="confrimData(index,driver)" 
                        />
                        <Button
                            type="button"
                            text="Delete"
                            class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" 
                            @click="deleteDriver(driver.id)" 
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

