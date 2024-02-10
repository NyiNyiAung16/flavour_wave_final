<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { filteredById } from '@/composable/search';
import { ref, computed } from 'vue';

const props = defineProps({
    urgents:{
        type:Array
    }
});

const headers = ref(['Id','Product Names','Quantity','Driver NRC','Truck Number','Truck Capacity','Pickup Date','Total Price','Status']);
const search = ref('');

const filteredUrgentOrders = computed(()=>{
    return filteredById(search.value,props.urgents)
});


</script>


<template>
    <div v-if="urgents.length > 0">
        <div class="flex justify-between items-center">
            <Search 
                @searching="(val) => search = val" 
                :howToSearch="'Id'" 
                class="w-3/4"
            />
            <Sorting 
                :items="filteredUrgentOrders" 
                sort-by="id" 
                @sorted="(val) => urgents = val"
                class="w-[370px]"
            />
        </div>
        <div class="sm:rounded-lg" :class="{'overflow-x-scroll': filteredUrgentOrders.length > 0}">
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin" 
                :is-department="$page.props.auth.user.department === 'LOGISTIC'"
                v-if="filteredUrgentOrders.length > 0"
            >
                <template #tbody>
                        <tr class="border-b item" v-for="(urgent,index) in urgents" :key="urgent.id">
                            <td class="py-4 px-2 text-center">{{index}}</td>
                            <td class="py-4 px-2 text-center">{{urgent.id}}</td>
                            <td class="py-4 px-2 flex gap-x-2 flex-wrap">
                                <span v-for="product in urgent.products" :key="product.id">{{ product.name }},</span>
                            </td>
                            <td class="py-4 px-2 text-center">{{urgent.order_quantity}}</td>
                            <td class="py-4 px-2">{{urgent.driver_nrc}}</td>
                            <td class="py-4 px-2 text-center">{{urgent.truck_number}}</td>
                            <td class="py-4 px-2 text-center">{{urgent.capacity}}</td>
                            <td class="py-4 px-2">{{urgent.date}}</td>
                            <td class="py-4 px-2">{{urgent.total_price}}$</td>
                            <td class="py-4 px-2"
                            :class="{'text-blue-400':urgent.status === 'order','text-green-500':urgent.status === 'deliver','text-red-500':urgent.status === 'cancel'}"
                            >{{urgent.status}}</td>
                        </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults/>
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any urgent orders!</p>
    </div>
</template>



