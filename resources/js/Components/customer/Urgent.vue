<script setup>
import { ref, computed } from 'vue';
import ConfrimModal from '@/Components/Modals/ConfrimModal.vue'
import CancelModal from '@/Components/Modals/CancelModal.vue'
import TableLayout from '@/Layouts/TableLayout.vue';
import { filteredById } from '@/composable/search';

const props = defineProps({
    urgents:{
        type:Array
    }
});

const headers = ref(['Id','Product Names','Quantity','Driver NRC','Truck Number','Truck Capacity','Total Price','Pickup Date','Preorder Date','Status'])
const confrimation = ref(false);
const cancelconfrimation = ref(false);
const preorderID = ref(null);
const search = ref('');

const filteredUrgentOrders = computed(()=>{
    return filteredById(search.value,props.urgents)
});

const showModal = (id) => {
    confrimation.value = true;
    preorderID.value = id;
}

const showCancelModal = (id) => {
    cancelconfrimation.value = true;
    preorderID.value = id;
}


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
                :is-department="$page.props.auth.user.department?.name === 'SALE'"
                v-if="filteredUrgentOrders.length > 0"
            >
                <template #tbody>
                    <tr class="border-b item" v-for="(urgent,index) in filteredUrgentOrders" :key="urgent.id">
                        <td class="py-4 px-2 text-center">{{index}}</td>
                        <td class="py-4 px-2 text-center">{{urgent.id}}</td>
                        <td class="py-4 px-2 flex gap-x-2 flex-wrap">
                            <span v-for="product in urgent.products" :key="product.id">{{ product.name }},</span>
                        </td>
                        <td class="py-4 px-2 text-center">{{urgent.order_quantity}}</td>
                        <td class="py-4 px-2 text-center">{{urgent.driver_nrc}}</td>
                        <td class="py-4 px-2 text-center">{{urgent.truck_number}}</td>
                        <td class="py-4 px-2 text-center">{{urgent.capacity}}</td>
                        <td class="py-4 px-2 text-center">{{urgent.total_price}}$</td>
                        <td class="py-4 px-2 text-center">{{urgent.date}}</td>
                        <td class="py-4 px-2 text-center">{{new Date(urgent.created_at).toLocaleDateString()}}</td>
                        <td class="py-4 px-2 text-center"
                        :class="{'text-yellow-400':urgent.status === 'pending','text-blue-400':urgent.status === 'order','text-green-500':urgent.status === 'deliver','text-red-500':urgent.status === 'cancel'}"
                        >{{urgent.status}}</td>
                        <td class="py-4 px-2 text-center" v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department?.name === 'SALE'">
                            <button class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold" @click="showModal(urgent.id)">confrim</button>
                            <button class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2" @click="showCancelModal(urgent.id)">cancel</button>
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
        <p>Don't have any urgent orders!</p>
    </div>
    <ConfrimModal :preorder_id="preorderID" :confrimation="confrimation" @hide-modal="confrimation = false"/>
    <CancelModal :preorder_id="preorderID" :cancelconfrimation="cancelconfrimation" @cancel-modal="cancelconfrimation = false"/>
</template>



