<script setup>
import Button from '@/Components/Button.vue'
import Body from '@/Components/Table/Body.vue';
import { router } from '@inertiajs/vue3';
import { showEdit, confrim, errors  } from '../../composable/editDriver'
import { ref,computed } from 'vue';
import TableLayout from '@/Layouts/TableLayout.vue';
import { filteredByName } from '@/composable/search';

const props = defineProps({
    drivers:{
        type:Array
    }
});

const headers = ref(['Driver ID','Name','Vehicle Number','IsFree','Created_at']);
const search = ref('');

const filteredDrivers = computed(()=>{
    return filteredByName(search.value,props.drivers)
});

const edit = (e, driver, index) => {
    showEdit(e, driver, index);
};

const confrimData = (index, driver) => {
    confrim(index, driver);
};

const deleteDriver = (id) => {
    router.delete(route("driver.destroy", id));
};
</script>

<template>
    <div v-if="drivers.length > 0">
        <div class="flex justify-between items-center">
            <Search 
                @searching="(val) => search = val" 
                :howToSearch="'name'" 
                class="w-3/4"
            />
            <Sorting 
                :items="filteredDrivers" 
                sort-by="name" 
                @sorted="(val) => drivers = val"
                class="w-[370px]"
            />
        </div>
        <div class="sm:rounded-lg" :class="{'overflow-x-scroll':filteredDrivers.length > 0}">
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin" 
                :is-department="$page.props.auth.user.department.name === 'LOGISTIC'"
                v-if="filteredDrivers.length > 0"
            >
                <template #tbody>
                        <tr class="border-b item" v-for="(driver,index) in filteredDrivers" :key="driver.id">
                            <td class="py-4 text-center">{{index}}</td>
                            <td class="py-4 text-center">{{driver.id}}</td>
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
                </template>
            </TableLayout>
            <template v-else>
                <NoResults/>
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any drivers!</p>
    </div>
</template>
